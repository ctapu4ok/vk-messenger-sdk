<?php declare(strict_types=1);

if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
}

use ctapu4ok\VkMessengerSdk\EventHandler;
use ctapu4ok\VkMessengerSdk\Logger;
use ctapu4ok\VkMessengerSdk\Settings;

enum Params
{
    public const API_HASH = 'vk1.a.GLlGmwNDe1iuRjb0a.....';
    public const GROUP_ID = 12345678;
    public const CONFIRM_STRING = 'c683e9eb12cebb65ce323467d8ab32508e55c7a0ecfecc0a0e92e31d8785adf4';

    public const VERSION = '5.81';
}

/**
 * Данный пример не является асинхронным!  На текущий момент не реализован асинхронный функционал работы с файлами
 */
class MessengerEvent extends EventHandler
{
    public function onStart(): void
    {
        $this->wrapper->getAPI()->logger('The event handler was initialized');
    }

    public function messageNew(int $group_id, ?string $secret, array $object): void
    {
        $this->wrapper->getAPI()->logger([
            'New message received: ', $object
        ], Logger::LOGGER_CALLABLE);

        /**
         * Получаем сервер для загрузки
         */
        $photoAlbums = $this->wrapper->getAPI()->vk->photos()->getMessagesUploadServer([
            'peer_id' => $object['message']['peer_id']
        ]);
        /**
         * Загружаем фотографию на сервер
         */
        $uploadedPhoto = $this->wrapper->getAPI()->vk->photos()->uploadPhotoToServer([
            'server' => $photoAlbums['upload_url'],
            'photo' => __DIR__.'/../assets/vk-messenger-logo.jpg'
        ]);
        /**
         * Сохраняем фото в сообщении
         */
        $savedMessage = $this->wrapper->getAPI()->vk->photos()->saveMessagesPhoto([
            'server' => $uploadedPhoto['server'],
            'photo'=>$uploadedPhoto['photo'],
            'hash' => $uploadedPhoto['hash']
        ]);
        $this->wrapper->getAPI()->logger([
            'Getting Message ID: ', $savedMessage
        ], Logger::LOGGER_CALLABLE);
        /**
         * Отправляем сообщение
         * @var $this->wrapper Main wrapper
         * @var $this->wrapper->getAPI()->vk The main VK API methods src/API/Actions
         */
        $msg_id = $this->wrapper->getAPI()->vk->messages()->send([
            'user_id' => $object['message']['from_id'],
            'random_id' => floor(microtime(true) * 1000),
            'peer_id' => $object['message']['peer_id'],
            'message' => 'Hello World!',
            'attachment' => 'photo'.$savedMessage[0]['owner_id'].'_'.$savedMessage[0]['id']
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

    MessengerEvent::loop($Settings);
}

extracted();
