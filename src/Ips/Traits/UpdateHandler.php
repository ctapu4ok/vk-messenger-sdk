<?php

namespace ctapu4ok\VkMessengerSdk\Ips\Traits;

use ctapu4ok\VkMessengerSdk\Logger;
use ctapu4ok\VkMessengerSdk\Tools\Utilities;
use Revolt\EventLoop;

trait UpdateHandler
{
    private array $updates = [];
    private int $updates_key = 0;

    private function handleUpdate(array $update): void
    {
        EventLoop::queue($this->eventUpdateHandler(...), $this->updates);
    }

    private function eventUpdateHandler(array $update): void
    {
        if ($f = $this->instance->waitForStartInternal()) {
            $this->logger->logger("Postponing update handling, onStart is still running (if stuck here for too long, make sure to fork long-running tasks in onStart using EventLoop::queue to fix this)...", Logger::NOTICE);
            $this->updates[$this->updates_key++] = $update;
            $f->map(
                function (): void {
                    \array_map($this->handleUpdate(...), $this->updates);
                    $this->updates = [];
                    $this->updates_key = 0;
                }
            );
            return;
        }
        $r = $this->methods[$update['_']]($update);
        if ($r instanceof \Generator) {
            Utilities::consumeGenerator($r);
        }
    }
}