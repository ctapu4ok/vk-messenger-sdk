<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk;

use ctapu4ok\VkMessengerSdk\Interfaces\DatabaseInterface;
use ctapu4ok\VkMessengerSdk\Settings\AppInfo;
use ctapu4ok\VkMessengerSdk\Settings\Database\Memory;
use ctapu4ok\VkMessengerSdk\Settings\Logger;

final class Settings extends SettingsAbstract
{
    /**
     * @var AppInfo App information
     */
    protected AppInfo $appInfo;

    protected Logger $logger;

    protected DatabaseInterface $db;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->appInfo = new AppInfo();
        $this->logger = new Logger();
        $this->db = new Memory();
    }

    /**
     * @return AppInfo
     */
    public function getAppInfo(): AppInfo
    {
        return $this->appInfo;
    }

    /**
     * @param  AppInfo $appInfo
     * @return void
     */
    public function setAppInfo(AppInfo $appInfo): void
    {
        $this->appInfo = $appInfo;
    }

    /**
     * @return Logger
     */
    public function getLogger(): Logger
    {
        return $this->logger;
    }

    /**
     * @param Logger $logger
     */
    public function setLogger(Logger $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * @return DatabaseInterface
     */
    public function getDb(): DatabaseInterface
    {
        return $this->db;
    }

    /**
     * @param DatabaseInterface $db
     */
    public function setDb(DatabaseInterface $db): void
    {
        $this->db = $db;
    }
}
