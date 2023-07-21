<?php declare(strict_types=1);

if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
}

use ctapu4ok\VkMessengerSdk\EventHandler;
use ctapu4ok\VkMessengerSdk\Logger;
use ctapu4ok\VkMessengerSdk\Settings;

enum Params
{
    public const API_HASH = 'vk1.a.GLlGmwNDe1iuR...';
    public const GROUP_ID = 12345678;
    public const CONFIRM_STRING = 'c683e9eb12cebb65ce...';

    public const VERSION = '5.81';
}

class MessengerEvent extends EventHandler
{
    public function messageNew(int $group_id, ?string $secret, array $object): void
    {
        if (!isset($object['message']['peer_id'])) {
            return;
        }

        $this->getAPI()->logger([
            'LOGGER_CALLABLE: '.$object['message']['id']
        ], Logger::LOGGER_CALLABLE);

        $this->getAPI()->logger([
            'LOGGER_FILE: '.$object['message']['id']
        ], Logger::LOGGER_FILE);

        $this->getAPI()->logger([
            'LOGGER_ECHO: '.$object['message']['id']
        ], Logger::LOGGER_ECHO);

        $this->getAPI()->logger([
            'LOGGER_DEFAULT: '.$object['message']['id']
        ], Logger::LOGGER_DEFAULT);

        $this->getAPI()->logger([
            'LEVEL_NOTICE: '.$object['message']['id']
        ], Logger::LEVEL_NOTICE);

        $this->getAPI()->logger([
            'LEVEL_ERROR: '.$object['message']['id']
        ], Logger::LEVEL_ERROR);

        $this->getAPI()->logger([
            'LEVEL_FATAL: '.$object['message']['id']
        ], Logger::LEVEL_FATAL);

        $this->getAPI()->logger([
            'LEVEL_VERBOSE: '.$object['message']['id']
        ], Logger::LEVEL_VERBOSE);

        $this->getAPI()->logger([
            'LEVEL_WARNING: '.$object['message']['id']
        ], Logger::LEVEL_WARNING);

        $this->getAPI()->logger([
            'LEVEL_ULTRA_VERBOSE: '.$object['message']['id']
        ], Logger::LEVEL_ULTRA_VERBOSE);
    }
}

function extracted(): void
{
    $Settings = new Settings();

    $Settings->getAppInfo()->setApiHash(Params::API_HASH);
    $Settings->getAppInfo()->setGroupId(Params::GROUP_ID);
    $Settings->getAppInfo()->setConfirmString(Params::CONFIRM_STRING);
    $Settings->getAppInfo()->setApiVersion(Params::VERSION);

    // Logging into file (without console)
    //$Settings->getLogger()
    //    ->setType(Logger::LOGGER_FILE)
    //    ->setExtra('log.file')
    //    ->setMaxSize(50*1024*1024);

    MessengerEvent::loop($Settings);
}

extracted();