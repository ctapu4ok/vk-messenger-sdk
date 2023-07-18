<?php declare(strict_types=1);

if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
}

use ctapu4ok\VkMessengerSdk\EventHandler;
use ctapu4ok\VkMessengerSdk\Settings;

enum Params
{
    public const API_HASH = 'vk1.a.Qyw6zef4YQZmosPX5Jj0fdXje......';
    public const GROUP_ID = 12345;
    public const CONFIRM_STRING = 'secret_string';
}

class MessengerEvent extends EventHandler
{
    public function messageEvent(int $group_id, ?string $secret, array $object): void
    {
        echo 'New Message Event'.PHP_EOL;
    }
    public function messageNew($group_id, $secret, $object)
    {
        echo 'New message'.PHP_EOL;
    }

    public function messageTypingState(int $group_id, ?string $secret, array $object)
    {
        echo 'The user started typing a message'.PHP_EOL;
    }
}

$Settings = new Settings();

$Settings->getAppInfo()->setApiHash(Params::API_HASH);
$Settings->getAppInfo()->setGroupId(Params::GROUP_ID);
$Settings->getAppInfo()->setConfirmString(PARAMS::CONFIRM_STRING);

MessengerEvent::loop($Settings);
