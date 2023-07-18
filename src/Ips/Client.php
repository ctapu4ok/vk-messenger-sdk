<?php

namespace ctapu4ok\VkMessengerSdk\Ips;

use ctapu4ok\VkMessengerSdk\API\VKApiClient;
use ctapu4ok\VkMessengerSdk\APIWrapper;
use ctapu4ok\VkMessengerSdk\Ips\Traits\Events;
use ctapu4ok\VkMessengerSdk\Ips\Traits\UpdateHandler;
use ctapu4ok\VkMessengerSdk\Logger;
use ctapu4ok\VkMessengerSdk\Settings;

final class Client
{
    use Events, UpdateHandler;

    public APIWrapper $wrapper;

    public VKApiClient $vk;

    public function __construct(Settings $settings, ?APIWrapper $wrapper = null)
    {
        $this->wrapper = $wrapper;
        $this->vk = new VKApiClient($settings);
    }

    public function start()
    {
        echo 'Starting...'.PHP_EOL;
    }

    public function startUpdateSystem(bool $anyway = false): void
    {
        $this->logger('The update system is running.');
        $UpdateLoop = new UpdateLoop($this);
        $UpdateLoop->loop();
    }

    public function logger(mixed $param, int $level = Logger::NOTICE, string $file = ''): void
    {
        print_r($this);
        //echo $param.PHP_EOL;
        ($this->logger ?? Logger::$default)->logger($param, $level, $file);
    }
}
