<?php

namespace ctapu4ok\VkMessengerSdk\Ips;

use Revolt\EventLoop;

class UpdateLoop
{
    private $API;
    public function __construct($API)
    {
        $this->API = $API;
    }
    public function loop(): void
    {
        $executor = new LongPollCallback($this->API);
        while (true) {
            try {
                $suspension = EventLoop::getSuspension();

                $repeatId = EventLoop::repeat(
                    1,
                    function () use ($executor) : void {
                        $executor->listen();
                    }
                );

                EventLoop::delay(
                    5,
                    function () use ($suspension, $repeatId): void {
                        EventLoop::cancel($repeatId);
                        $suspension->resume(null);
                    }
                );
                $suspension->suspend();
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}
