<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk\Database;

use Amp\Mysql\MysqlConfig;
use Amp\Mysql\MysqlConnectionPool;
use ctapu4ok\VkMessengerSdk\Interfaces\DatabaseInterface;
use ctapu4ok\VkMessengerSdk\Settings\Database\Mysql;

class MysqlDriver
{
    private static $instance = null;
    public static function getInstance(DatabaseInterface $settings)
    {
        if (empty(self::$instance)) {
            self::$instance = new Mysql($settings);
        }

        return self::$instance;
    }
}
