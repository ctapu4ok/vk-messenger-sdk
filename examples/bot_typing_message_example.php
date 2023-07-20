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
    public const CONFIRM_STRING = 'c683e9eb12cebb65ce.....';

    public const VERSION = '5.81';
}

class MessengerEvent extends EventHandler
{
    /**
     *  We catch when the user starts typing a message
     * @param int $group_id
     * @param string|null $secret
     * @param array $object
     * @return void
     */
    public function messageTypingState(int $group_id, ?string $secret, array $object): void
    {
        $this->wrapper->getAPI()->logger([
            'The user started typing a message', $object
        ], Logger::LOGGER_CALLABLE);


        $user = $this->wrapper->getAPI()->vk->users()->get([
            'user_ids' => $object['from_id'],
            'fields' => 'id,first_name,last_name,about,activities,bdate,city,country,sex'
        ]);

        if (!count($user)) {
            if (!isset($user[0]['id'])) {
                return;
            }
        }
        /**
         * The bot pretends to typing a message
         */
        $this->wrapper->getAPI()->vk->messages()->setActivity([
            'user_id' => $user[0]['id'],
            'type' => 'typing',
        ]);
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