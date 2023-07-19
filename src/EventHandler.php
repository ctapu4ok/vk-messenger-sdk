<?php

namespace ctapu4ok\VkMessengerSdk;

use ctapu4ok\VkMessengerSdk\Database\Traits\DbProperties;

abstract class EventHandler extends AbstractAPI
{
    public function onStart(): void
    {
    }
    final public static function loop(Settings $settings)
    {
        $API = new API($settings);
        $API->startAndLoopInternal(static::class);
    }

    protected function reconnectFull(): bool
    {
        return true;
    }

    public function initInternal(APIWrapper $wrapper): void
    {
        $this->wrapper = $wrapper;
        $this->wrapper->getAPI()->logger->logger('Initializing the application');
    }

    public function startInternal(): void
    {
        $this->wrapper->getAPI()->logger->logger('Launching the application');
    }
}
