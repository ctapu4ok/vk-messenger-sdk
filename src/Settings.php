<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk;

use ctapu4ok\VkMessengerSdk\Settings\AppInfo;

final class Settings extends SettingsAbstract
{
    /**
     * @var AppInfo App information
     */
    protected AppInfo $appInfo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->appInfo = new AppInfo();
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
}