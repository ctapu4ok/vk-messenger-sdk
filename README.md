# VK Messenger SDK a PHP LongPoll VK messenger client

**VK Messenger SDK** is a system that allows you to interact with the VK API via LongPoll in asynchronous mode.

LongPoll is a mechanism provided by the VK API that allows you to receive updates from the social network in real time. To interact with the LongPoll API, you need to create a connection to the VK server and wait for new events to appear.

To implement asynchronous operation mode, we use the callback mechanism. When a new event occurs in the VK system, our project receives it and calls the corresponding callback, which the user has previously defined. Thus, the user can create his own logic for processing received events, for example, to send notifications or perform other actions.

PHP library for VK API interaction, includes [LongPoll Server](https://dev.vk.com/method/groups.getLongPollServer) and API methods

It uses VK LongPoll API [version](https://vk.com/dev/versions) 5.81


[![Packagist](https://img.shields.io/packagist/v/ctapu4ok/vk-messenger-sdk.svg)](https://packagist.org/packages/ctapu4ok/vk-messenger-sdk)

Do join the official channel [@vk_messenger_sdk](https://t.me/vk_messenger_sdk)

## 1. Prerequisites

* PHP 8.2^

## 2. Installation

The VK Messenger SDK can be installed using Composer by running the following command:

```sh
composer require ctapu4ok/vk-messenger-sdk
```

## 3. Example

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
    public const API_HASH = 'vk1.a.Qyw6zef4YQZmosX......';
    public const GROUP_ID = 12345678;
    public const CONFIRM_STRING = 'c683e9eb12cebb...........';

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
            'New message received', $object
        ], Logger::LOGGER_CALLABLE);


        /**
         * @var $this->wrapper Main wrapper
         * @var $this->wrapper->getAPI()->vk The main VK API methods src/API/Actions
         */
        $this->wrapper->getAPI()->vk->messages()->send([
            'user_id' => $object['message']['from_id'],
            'random_id' => floor(microtime(true) * 1000),
            'peer_id' => $object['message']['peer_id'],
            'message' => 'Hello World!'
        ]);
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

MessengerEvent::loop($Settings);
```