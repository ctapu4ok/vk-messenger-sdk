<?php declare(strict_types=1);

if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
}

use ctapu4ok\VkMessengerSdk\EventHandler;
use ctapu4ok\VkMessengerSdk\Logger;
use ctapu4ok\VkMessengerSdk\Settings;

enum Params
{
    public const API_HASH = 'vk1.a.GLlGmwNDe1iuRjb0aR...';
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
        $this->getAPI()->logger([
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
         * @var $this->getVk() The main VK API methods src/API/Actions
         */
        $msg_id = $this->getVk()->messages()->send([
            'user_id' => $object['message']['from_id'],
            'random_id' => floor(microtime(true) * 1000),
            'peer_id' => $object['message']['peer_id'],
            'message' => 'Hello World!'
        ]);

        $this->getAPI()->logger([
            'Getting Message ID: ', $msg_id
        ], Logger::LOGGER_CALLABLE);
    }

    private function testTransaction()
    {
        $this->transactions[$this->peer_id] = 1;
        \Amp\async(function () {
            $check = 1000;
            $transaction = $this->getAPI()->db->beginTransaction();
            try {
                for ($i = 0; $i < 15500; $i++) {
                    if ($check == $i) {
                        $this->getAPI()->logger([
                            'Point: ' . $i . ' Memory usage: ' . $this->convert(memory_get_usage(true))
                        ], Logger::LEVEL_ERROR);
                        $check = $check * 2;
                    }
                    $transaction->execute("INSERT INTO `test` (`text`) VALUES (?)", [$i]);
                }
                $transaction->commit();
            } catch (\Amp\Sql\SqlException|
                \Amp\Sql\QueryError|
                \Amp\Sql\TransactionError $e) {
                $transaction->rollback();
                unset($this->transactions[$this->peer_id]);
                $this->getAPI()->logger($e->getMessage(), Logger::LEVEL_ERROR);
            }
            unset($this->transactions[$this->peer_id]);
        });
    }

    private function convert($size): string
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024, ($i=floor(log($size, 1024)))), 2).' '.$unit[$i];
    }
}

/**
 * @return void
 */
function extracted(): void
{
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
}

extracted();
