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
    public const API_HASH = 'vk1.a.GLlGmwNDe1iuRjb0a.....';
    public const GROUP_ID = 1234567;
    public const CONFIRM_STRING = 'c683e9eb12cebb65ce323467d8ab32508e55c7a0ecfecc0a0e92e31d8785adf4';

    public const VERSION = '5.81';
}

/**
 * Пример редактирования информации о группе
 */
class MessengerEvent extends EventHandler
{
    public function messageNew(int $group_id, ?string $secret, array $object): void
    {
        $this->getAPI()->logger([
            'New message received: ', $object
        ], Logger::LOGGER_CALLABLE);

        /**
         *
         * Полный список параметров тут https://dev.vk.com/method/groups.edit
         * @var $this->getVk() The main VK API methods src/API/Actions
         */
        $groupInfo = $this->getVk()->groups()->edit([
            'group_id' => 1234567,
            'title' => 'Название сообщества.',
            'description' => 'Описание сообщества.',
            'screen_name' => 'Короткое имя сообщества'
        ]);

        $this->getAPI()->logger([
            'Getting Message ID: ', $groupInfo
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
