<?php

namespace ctapu4ok\VkMessengerSdk\Tools;

use Amp\DeferredFuture;
use Amp\Future;
use function Amp\async;

abstract class AsyncUtilities
{
    public static function call(mixed $promise): Future
    {
        if ($promise instanceof \Generator) {
            return async(self::consumeGenerator(...), $promise);
        }

        if (!$promise instanceof Future) {
            $future = new DeferredFuture;
            $future->complete($promise);
            return $future->getFuture();
        }
        return $promise;
    }

    public static function consumeGenerator(\Generator $generator): mixed
    {
        $yield = $generator->current();
        do {
            while (!$yield instanceof Future) {
                if (!$generator->valid()) {
                    return $generator->getReturn();
                }
                if ($yield instanceof \Generator) {
                    $yield = self::consumeGenerator($yield);
                } elseif (\is_array($yield)) {
                    $yield = \array_map(
                        fn($v) => $v instanceof \Generator ? self::consumeGenerator($v) : $v,
                        $yield
                    );
                    $yield = $generator->send($yield);
                } else {
                    $yield = $generator->send($yield);
                }
            }
            try {
                $result = $yield->await();
            } catch (\Throwable $e) {
                $yield = $generator->throw($e);
                continue;
            }
            $yield = $generator->send($result);
        } while (1);
    }
}