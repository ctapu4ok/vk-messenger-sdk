<?php declare(strict_types=1);

if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
}

use ctapu4ok\VkMessengerSdk\EventHandler;
use ctapu4ok\VkMessengerSdk\Logger;
use ctapu4ok\VkMessengerSdk\Settings;

enum Params
{
    public const API_HASH = 'vk1.a.Qyw6zef4YQZmosPX5J.....';
    public const GROUP_ID = 12345678;
    public const CONFIRM_STRING = 'c683e9eb12cebb65ce.....';

    public const VERSION = '5.81';
}

class MessengerEvent extends EventHandler
{
    public function onStart(): void
    {
        $this->wrapper->getAPI()->logger('The event handler was initialized');
    }
    public function messageEvent(int $group_id, ?string $secret, array $object): void
    {
        $this->wrapper->getAPI()->logger([
            'New message event received', $object
        ], Logger::LOGGER_CALLABLE);
    }
    public function messageNew(int $group_id, ?string $secret, array $object): void
    {
        $this->wrapper->getAPI()->logger([
            'New message received: ', $object
        ], Logger::LOGGER_CALLABLE);

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

    public function messageTypingState(int $group_id, ?string $secret, array $object): void
    {
        $this->wrapper->getAPI()->logger([
            'The user started typing a message', $object
        ], Logger::LOGGER_CALLABLE);
    }
}

$Settings = new Settings();

$Settings->getAppInfo()->setApiHash(Params::API_HASH);
$Settings->getAppInfo()->setGroupId(Params::GROUP_ID);
$Settings->getAppInfo()->setConfirmString(Params::CONFIRM_STRING);
$Settings->getAppInfo()->setApiVersion(Params::VERSION);

// we say to output logs to a file (without console)
//$Settings->getLogger()
//    ->setType(Logger::LOGGER_FILE)
//    ->setExtra('log.file')
//    ->setMaxSize(50*1024*1024);
// Database settings
//$Settings->setDb(
//    (new Settings\Database\Mysql())
//    ->setUri('127.0.0.1:3306')
//    ->setDatabase('vk_messenger')
//    ->setUsername('root')
//    ->setPassword('root')
//);

MessengerEvent::loop($Settings);
