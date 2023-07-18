<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk;

use Amp\Future\UnhandledFutureError;
use Amp\SignalException;
use ctapu4ok\VkMessengerSdk\API\CallbackApiHandler;
use Revolt\EventLoop;

abstract class AbstractAPI extends CallbackApiHandler
{
    public APIWrapper $wrapper;
    /**
     * @param  string $eventHandler
     * @return void
     */
    protected function startAndLoopInternal(string $eventHandler): void
    {
        $started = false;
        $errors = [];
        $prev = EventLoop::getErrorHandler();

        EventLoop::setErrorHandler(
            $c = function (\Throwable $e) use (&$errors, &$started): void {
                if ($e instanceof UnhandledFutureError) {
                    $e = $e->getPrevious();
                }

                if ($e instanceof SignalException) {
                    throw $e;
                }

                if (\str_starts_with($e->getMessage(), 'Could not connect ')) {
                    throw $e;
                }

                $time = \time();
                $errors = [$time => $errors[$time] ?? 0];
                $errors[$time]++;
                if ($errors[$time] > 15 && (!$started || !$this->wrapper->getAPI()->isInit())) {
                    $this->wrapper->getAPI()->logger->logger('More than 10 errors per second, exiting!', Logger::FATAL_ERROR);
                    return;
                }
                $this->wrapper->getAPI()->logger->logger((string) $e, Logger::FATAL_ERROR);
            }
        );

        try {
            $this->startAndLoopLogic($eventHandler, $started);
        } finally {
            if (EventLoop::getErrorHandler() === $c) {
                EventLoop::setErrorHandler($prev);
            }
        }
    }

    /**
     * @return bool
     */
    abstract protected function reconnectFull(): bool;

    /**
     * @param  string $eventHandler
     * @param  bool   $started
     * @return void
     */
    protected function startAndLoopLogic(string $eventHandler, bool &$started): void
    {
        $this->wrapper->getAPI()->start();
        if (!$this->reconnectFull()) {
            return;
        }

        $this->wrapper->getAPI()->setEventHandler($eventHandler);
        $started = true;

        $this->wrapper->getAPI()->loop();
    }

    /**
     * @return array
     */
    public function __sleep(): array
    {
        return [];
    }
}
