<?php

namespace ctapu4ok\VkMessengerSdk;

abstract class EventHandler extends AbstractAPI
{
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
        echo "Initializing the application...".PHP_EOL;
        $this->wrapper = $wrapper;
    }

    public function startInternal(): void
    {
        echo 'Application Start'.PHP_EOL;
    }
}
