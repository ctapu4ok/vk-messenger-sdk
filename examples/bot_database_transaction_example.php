<?php declare(strict_types=1);

if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
}

use ctapu4ok\VkMessengerSdk\EventHandler;
use ctapu4ok\VkMessengerSdk\Logger;
use ctapu4ok\VkMessengerSdk\Settings;

enum Params
{
    public const API_HASH = 'vk1.a.Qyw6zef4YQZmos...';
    public const GROUP_ID = 12345678;
    public const CONFIRM_STRING = 'c683e9eb12cebb65ce...';

    public const VERSION = '5.81';
}

class MessengerEvent extends EventHandler
{
    private array $transactions = [];

    private int $peer_id;

    public function messageNew(int $group_id, ?string $secret, array $object): void
    {
        $this->wrapper->getAPI()->logger([
            'New message received: '.$object['message']['id']
        ], Logger::LOGGER_CALLABLE);

        if (!isset($object['message']['peer_id'])) {
            return;
        }

        $this->peer_id = $object['message']['peer_id'];

        if (!isset($this->transactions[$this->peer_id])) {
            $this->testTransaction();
        }

        /**
         * @var $this->wrapper Main wrapper
         * @var $this->wrapper->getAPI()->vk The main VK API methods src/API/Actions
         */
        $msg_id = $this->wrapper->getAPI()->vk->messages()->send([
            'user_id' => $object['message']['from_id'],
            'random_id' => floor(microtime(true) * 1000),
            'peer_id' => $object['message']['peer_id'],
            'message' => 'Hello World!'
        ]);

        $this->wrapper->getAPI()->logger([
            'Getting Message ID: ', $msg_id
        ], Logger::LOGGER_CALLABLE);
    }

    private function testTransaction()
    {
        $this->transactions[$this->peer_id] = 1;
        \Amp\async(function () {
            $check = 1000;
            $transaction = $this->wrapper->getAPI()->db->beginTransaction();
            for ($i = 0; $i < 32000; $i++) {
                if ($check == $i) {
                    $this->wrapper->getAPI()->logger([
                        'Point: ' . $i . ' Memory usage: ' . $this->convert(memory_get_usage(true))
                    ], Logger::LEVEL_ERROR);
                    $check = $check * 2;
                }
                $transaction->execute("INSERT INTO `test` (`text`) VALUES (?)", ['This is STRING: ' . $i]);
            }
            $transaction->commit();
            unset($this->transactions[$this->peer_id]);
        });
    }

    private function convert($size): string
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024, ($i=floor(log($size, 1024)))), 2).' '.$unit[$i];
    }
}

$Settings = new Settings();

$Settings->getAppInfo()->setApiHash(Params::API_HASH);
$Settings->getAppInfo()->setGroupId(Params::GROUP_ID);
$Settings->getAppInfo()->setConfirmString(Params::CONFIRM_STRING);
$Settings->getAppInfo()->setApiVersion(Params::VERSION);

$Settings->setDb(
    (new Settings\Database\Mysql())
        ->setUri('127.0.0.1:3306')
        ->setDatabase('vk_messenger')
        ->setUsername('root')
        ->setPassword('root')
);

MessengerEvent::loop($Settings);
