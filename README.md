# VK Messenger SDK PHP LongPoll клиент

[Instructions in English](https://github.com/ctapu4ok/vk-messenger-sdk/blob/master/README_EN.md)

**VK Messenger SDK** представляет собой систему, которая позволяет взаимодействовать с API ВКонтакте через LongPoll в асинхронном режиме.

LongPoll - это механизм, предоставляемый API ВКонтакте, который позволяет получать обновления из социальной сети в режиме реального времени. 

Для реализации асинхронного режима работы проект использует механизм обратных вызовов (callback / event loop). Когда происходит новое событие в системе ВКонтакте, обработчик получает его и вызывает соответствующий обратный вызов, который пользователь предварительно определил. Таким образом, пользователь может создать свою логику обработки полученных событий.

Библиотека PHP для взаимодействия с VK API, включающая [LongPoll Server](https://dev.vk.com/method/groups.getLongPollServer) и API методы

Используемая версия ВК API [version](https://vk.com/dev/versions) 5.81


[![Packagist](https://img.shields.io/packagist/v/ctapu4ok/vk-messenger-sdk.svg)](https://packagist.org/packages/ctapu4ok/vk-messenger-sdk)

## 1. Предусловия

* PHP 8.2^

## 2. Установка

The VK Messenger SDK можно установить с помощью Composer, выполнив следующую команду:

```sh
composer require ctapu4ok/vk-messenger-sdk
```

## 3. Примеры 
#### (постепенно пополняется)

[Пример простого бота](https://github.com/ctapu4ok/vk-messenger-sdk/blob/master/examples/bot_example.php)

#### 1. Сообщения
2. [Отправление сообщения с кнопками](https://github.com/ctapu4ok/vk-messenger-sdk/blob/master/examples/bot_buttons_example.php)
3. [Имитация набора текста ботом](https://github.com/ctapu4ok/vk-messenger-sdk/blob/master/examples/bot_typing_message_example.php)

#### 2. Группы
1. [Получения информации о группе](https://github.com/ctapu4ok/vk-messenger-sdk/blob/master/examples/bot_groups_getById_example.php)
2. [Редактирование группы](https://github.com/ctapu4ok/vk-messenger-sdk/blob/master/examples/bot_groups_edit.php)

#### 3. Остальное
1. [Выполнение SQL запроса](https://github.com/ctapu4ok/vk-messenger-sdk/blob/master/examples/bot_database_query_example.php)
2. [Выполнение транзакций](https://github.com/ctapu4ok/vk-messenger-sdk/blob/master/examples/bot_database_transaction_example.php)
3. [Пример с модулем Logger](https://github.com/ctapu4ok/vk-messenger-sdk/blob/master/examples/bot_logger_example.php)

>[Больше примеров](https://github.com/ctapu4ok/vk-messenger-sdk/tree/master/examples)


## 4. Пример бота
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
    
    /**
    * Cron example  
    */ 
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