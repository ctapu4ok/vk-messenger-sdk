# vk-messenger-sdk

**VK Messenger SDK** is a system that allows you to interact with the VK API via LongPoll in asynchronous mode.

LongPoll is a mechanism provided by the VK API that allows you to receive updates from the social network in real time. To interact with the LongPoll API, you need to create a connection to the VK server and wait for new events to appear.

To implement asynchronous operation mode, we use the callback mechanism. When a new event occurs in the VK system, our project receives it and calls the corresponding callback, which the user has previously defined. Thus, the user can create his own logic for processing received events, for example, to send notifications or perform other actions.

PHP library for VK API interaction, includes [LongPoll Server](https://dev.vk.com/method/groups.getLongPollServer) and API methods

It uses VK LongPoll API [version](https://vk.com/dev/versions) 5.81

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
use ctapu4ok\VkMessengerSdk\Settings;

enum Params
{
    public const API_HASH = 'vk1.a.Qyw6zef4YQZmosPX5Jj......';
    public const GROUP_ID = 123456;
    public const CONFIRM_STRING = 'secret_string';

    public const VERSION = '5.81';
}

class MessengerEvent extends EventHandler
{
    public function messageEvent(int $group_id, ?string $secret, array $object): void
    {
        echo 'New message event received'.PHP_EOL;
    }
    public function messageNew($group_id, $secret, $object)
    {
        echo 'New message received'.PHP_EOL;
        /**
         * @var {$this->wrapper} Main wrapper
         * @var {$this->wrapper->getAPI()->vk} The main VK API methods src/API/Actions
         */
        $this->wrapper->getAPI()->vk->messages()->send([
            'user_id' => $object['message']['from_id'],
            'random_id' => floor(microtime(true) * 1000),
            'peer_id' => $object['message']['peer_id'],
            'message' => 'Hello World!'
        ]);
    }

    public function messageTypingState(int $group_id, ?string $secret, array $object)
    {
        echo 'The user started typing a message'.PHP_EOL;
    }
}

$Settings = new Settings();

$Settings->getAppInfo()->setApiHash(Params::API_HASH);
$Settings->getAppInfo()->setGroupId(Params::GROUP_ID);
$Settings->getAppInfo()->setConfirmString(Params::CONFIRM_STRING);
$Settings->getAppInfo()->setApiVersion(Params::VERSION);

MessengerEvent::loop($Settings);


```