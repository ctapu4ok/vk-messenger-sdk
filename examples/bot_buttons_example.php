<?php declare(strict_types=1);

if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
}

use ctapu4ok\VkMessengerSdk\EventHandler;
use ctapu4ok\VkMessengerSdk\Logger;
use ctapu4ok\VkMessengerSdk\Settings;

enum Params
{
    public const API_HASH = 'vk1.a.GLlGmwNDe1iuRj...';
    public const GROUP_ID = 12345678;
    public const CONFIRM_STRING = 'c683e9eb12cebb65ce.....';

    public const VERSION = '5.81';
}

class MessengerEvent extends EventHandler
{
    public function messageEvent(int $group_id, ?string $secret, array $object)
    {
        $this->wrapper->getAPI()->logger([
            'Button clicked: ', $object
        ], Logger::LOGGER_CALLABLE);

        $this->wrapper->getAPI()->vk->messages()->sendMessageEventAnswer([
            'event_id' => $object['event_id'],
            'user_id' => $object['user_id'],
            'peer_id' => $object['peer_id']
        ]);
    }
    public function messageNew(int $group_id, ?string $secret, array $object): void
    {
        $this->wrapper->getAPI()->logger([
            'New message received: ', $object
        ], Logger::LOGGER_CALLABLE);

        $buttonTypes = [
            'callback',
            'open_link',
            'open_app'
        ];

        $buttonsPerRow = 1;
        $numberOfRows = count($buttonTypes) / $buttonsPerRow;
        $buttonOffset = 0;
        $rowButtons = [];

        for ($row = 0; $row < $numberOfRows; $row++) {
            $rowButtons[$row] = [];
            for ($i=0; $i<$buttonsPerRow; $i++) {
                if (isset($buttonTypes[$buttonOffset])) {
                    $rowButtons[$row][$i] = match ($buttonTypes[$buttonOffset]) {
                        'callback' => [
                            'action' => [
                                'type' => 'callback',
                                'payload' => '{"some_returned_param":"CALLBACK"}',
                                'label' => "Callback Btn",
                            ]
                        ],
                        'open_link'=> [
                            'action' => [
                                'type' => 'open_link',
                                'label' => "Open Link Btn",
                                'link' => 'https://github.com/ctapu4ok/vk-messenger-sdk'
                            ]
                        ],
                        'open_app' => [
                            'action' => [
                                'type' => 'open_app',
                                'payload' => '{"some_returned_param":"open_app"}',
                                'label' => "Open App Btn",
                                'app_id' => 123456789,
                                'hash' => 'SOME_HASH',
                            ]
                        ]
                    };
                    $buttonOffset++;
                }
            }
        }
        /**
         * @var $this->wrapper Main wrapper
         * @var $this->wrapper->getAPI()->vk The main VK API methods src/API/Actions
         */
        $msg_id = $this->wrapper->getAPI()->vk->messages()->send([
            'user_id' => $object['message']['from_id'],
            'random_id' => floor(microtime(true) * 1000),
            'peer_id' => $object['message']['peer_id'],
            'message' => 'Hello World!',
            'keyboard' => json_encode([
                'inline' => true,
                'buttons' => $rowButtons
            ])
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
