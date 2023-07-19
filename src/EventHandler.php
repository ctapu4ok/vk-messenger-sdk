<?php

namespace ctapu4ok\VkMessengerSdk;

use ctapu4ok\VkMessengerSdk\Attributes\Cron;
use ctapu4ok\VkMessengerSdk\Database\Traits\DbProperties;
use Revolt\EventLoop;

abstract class EventHandler extends AbstractAPI
{
    private array $proccess = [];
    private array $periodicLoops = [];
    public function onStart(): void
    {
    }

    public function onCron(): void
    {
        $handler = $this->wrapper->getAPI()->getInstance();

        EventLoop::defer(function () use ($handler): void {
            foreach ((new \ReflectionClass($this))->getMethods(\ReflectionMethod::IS_PUBLIC) as $methodRefs) {
                $method = $methodRefs->getName();
                if (!isset($this->proccess[$method])) {
                    $this->proccess[$method] = 1;
                    if ($periodic = $methodRefs->getAttributes(Cron::class)) {
                        $periodic = $periodic[0]->newInstance();

                        $this->periodicLoops[$method] = EventLoop::repeat(
                            $periodic->period,
                            function () use ($periodic, $method, $handler): void {
                                $this->wrapper->getAPI()->logger->logger("Cron running: ".$method);
                                $handler->$method();
                                unset($this->proccess[$method]);
                            }
                        );
                    }
                }
            }
        });
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
