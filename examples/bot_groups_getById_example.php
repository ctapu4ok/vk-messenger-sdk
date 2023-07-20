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
 * Пример получения информации о группе / группах по ID
 */
class MessengerEvent extends EventHandler
{
    public function messageNew(int $group_id, ?string $secret, array $object): void
    {
        $this->wrapper->getAPI()->logger([
            'New message received: ', $object
        ], Logger::LOGGER_CALLABLE);

        /**
         * @var $this->wrapper Main wrapper
         * @var $this->wrapper->getAPI()->vk The main VK API methods src/API/Actions
         */
        $groupInfo = $this->wrapper->getAPI()->vk->groups()->getById([
            'group_ids' => [1234567, 7654321],
            //'group_id' => 1234567
            'fields' => [
                'id',
                'name',
                'screen_name',
                'is_closed',
                'deactivated',
                'is_admin',
                'admin_level',
                'is_member',
                'is_advertiser',
                'invited_by',
                'type',
                'photo_50',
                'photo_100',
                'photo_200',
                'activity',
                'addresses',
                'age_limits',
                'ban_info',
                'can_create_topic',
                'can_message',
                'can_post',
                'can_suggest',
                'can_see_all_posts',
                'can_upload_doc',
                'can_upload_story',
                'can_upload_video',
                'city',
                'contacts',
                'counters',
                'country',
                'cover',
                'crop_photo',
                'description',
                'fixed_post',
                'has_photo',
                'is_favorite',
                'is_hidden_from_feed',
                'is_messages_blocked',
                'links',
                'main_album_id',
                'main_section',
                'market',
                'member_status',
                'members_count',
                'place',
                'public_date_label',
                'site',
                'start_date и finish_date',
                'status',
                'trending',
                'verified',
                'wall',
                'wiki_page'
            ]
        ]);

        $this->wrapper->getAPI()->logger([
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
