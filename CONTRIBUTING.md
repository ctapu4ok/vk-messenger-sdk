# VK Messenger SDK a PHP LongPoll VK messenger client

[Инструкция на Русском](https://github.com/ctapu4ok/vk-messenger-sdk/blob/master/README.md)

**VK Messenger SDK** is a system that allows you to interact with the VK API via LongPoll in asynchronous mode.

LongPoll is a mechanism provided by the VK API that allows you to receive updates from the social network in real time. To interact with the LongPoll API, you need to create a connection to the VK server and wait for new events to appear.

To implement asynchronous operation mode, we use the callback mechanism. When a new event occurs in the VK system, our project receives it and calls the corresponding callback, which the user has previously defined. Thus, the user can create his own logic for processing received events, for example, to send notifications or perform other actions.

PHP library for VK API interaction, includes [LongPoll Server](https://dev.vk.com/method/groups.getLongPollServer) and API methods

It uses VK LongPoll API [version](https://vk.com/dev/versions) 5.81


[![Packagist](https://img.shields.io/packagist/v/ctapu4ok/vk-messenger-sdk.svg)](https://packagist.org/packages/ctapu4ok/vk-messenger-sdk)

## 1. Prerequisites

* PHP 8.2^

## 2. Installation

The VK Messenger SDK can be installed using Composer by running the following command:

```sh
composer require ctapu4ok/vk-messenger-sdk
```

## 3. Example
>[More examples here](https://github.com/ctapu4ok/vk-messenger-sdk/tree/master/examples)
 
## 4. Bot example

```php
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
        $this->getAPI()->logger('The event handler was initialized');
    }
    public function messageEvent(int $group_id, ?string $secret, array $object): void
    {
        $this->getAPI()->logger([
            'New message event received', $object
        ], Logger::LOGGER_CALLABLE);
    }
    public function messageNew(int $group_id, ?string $secret, array $object): void
    {
        $this->getAPI()->logger([
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

        $this->getAPI()->logger([
            'Getting Message ID: ', $msg_id
        ], Logger::LOGGER_CALLABLE);
    }

    public function messageTypingState(int $group_id, ?string $secret, array $object): void
    {
        $this->getAPI()->logger([
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

```
