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

        $statement = $this->wrapper->getAPI()->db->prepare('SELECT * FROM test WHERE id = :id');

        $result = $statement->execute(['id' => $this->peer_id]);

        foreach ($result as $item) {
            $this->wrapper->getAPI()->logger([
                'Item '.$item['id']
            ], Logger::LOGGER_CALLABLE);
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

        $this->wrapper->getAPI()->logger([
            'Getting Message ID: ', $msg_id
        ], Logger::LOGGER_CALLABLE);
    }
}

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
