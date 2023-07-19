<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk\Database;

use ctapu4ok\VkMessengerSdk\Interfaces\DatabaseInterface;

class MemoryDriver
{
    private static $instance = null;
    public static function getInstance(DatabaseInterface $settings)
    {
        if (empty(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
