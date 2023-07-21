<?php declare(strict_types=1);

if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
}

use ctapu4ok\VkMessengerSdk\EventHandler;
use ctapu4ok\VkMessengerSdk\Logger;
use ctapu4ok\VkMessengerSdk\Settings;
use ctapu4ok\VkMessengerSdk\Attributes\Cron;

enum Params
{
    public const API_HASH = 'vk1.a.GLlGmwNDe1iuRj....';
    public const GROUP_ID = 12345678;
    public const CONFIRM_STRING = 'c683e9eb12cebb65ce323467d8ab32508e55c7a0ecfecc0a0e92e31d8785adf4';

    public const VERSION = '5.81';
}

class MessengerEvent extends EventHandler
{
    public function messageNew(int $group_id, ?string $secret, array $object): void
    {
        $this->wrapper->getAPI()->logger([
            'New message received: ', $object
        ], Logger::LOGGER_CALLABLE);

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

    public function messageTypingState(int $group_id, ?string $secret, array $object): void
    {
        $this->wrapper->getAPI()->logger([
            'The user started typing a message', $object
        ], Logger::LOGGER_CALLABLE);
    }

    #[Cron(period: 5)]
    public function testingCron5()
    {
        $this->wrapper->getAPI()->logger([
            'THIS IS CRON 5!!!!!!'
        ], Logger::LOGGER_CALLABLE);
    }

    #[Cron(period: 1)]
    public function testingSome1()
    {
        $this->wrapper->getAPI()->logger([
            'THIS IS CRON 1.0!!!!!!'
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

    MessengerEvent::loop($Settings);
}

extracted();


//Result
//EventHandler, 221505952:        Cron running: testingSome1
//Client, 221505952:              [
//    "THIS IS CRON 1.0!!!!!!"
//]
//EventHandler, 221505952:        Cron running: testingSome1
//Client, 221505952:              [
//    "THIS IS CRON 1.0!!!!!!"
//]
//EventHandler, 221505952:        Cron running: testingSome1
//Client, 221505952:              [
//    "THIS IS CRON 1.0!!!!!!"
//]
//EventHandler, 221505952:        Cron running: testingSome1
//Client, 221505952:              [
//    "THIS IS CRON 1.0!!!!!!"
//]
//EventHandler, 221505952:        Cron running: testingCron5
//Client, 221505952:              [
//    "THIS IS CRON 5!!!!!!"
//]
//EventHandler, 221505952:        Cron running: testingSome1
//Client, 221505952:              [
//    "THIS IS CRON 1.0!!!!!!"
//]
//EventHandler, 221505952:        Cron running: testingSome1
//Client, 221505952:              [
//    "THIS IS CRON 1.0!!!!!!"
//]
//EventHandler, 221505952:        Cron running: testingSome1
//Client, 221505952:              [
//    "THIS IS CRON 1.0!!!!!!"
//]
//EventHandler, 221505952:        Cron running: testingSome1
//Client, 221505952:              [
//    "THIS IS CRON 1.0!!!!!!"
//]
//EventHandler, 221505952:        Cron running: testingCron5
//Client, 221505952:              [
//    "THIS IS CRON 5!!!!!!"
//]