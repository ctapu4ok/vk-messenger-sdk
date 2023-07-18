<?php

use ctapu4ok\VkMessengerSdk\Settings;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class SettingsTest extends TestCase
{
    protected $settings;

    protected function setUp(): void
    {
        $this->settings = new Settings();
    }

    protected function tearDown(): void
    {
        $this->settings = null;
    }

    #[Test]
    public function SetAppInfo()
    {
        $this->settings->setAppInfo(new Settings\AppInfo());

        $this->assertObjectHasProperty('groupId',$this->settings->getAppInfo());
    }

    #[Test]
    public function GetAppInfo()
    {
        $this->settings->getAppInfo();

        $this->assertObjectHasProperty('groupId',$this->settings->getAppInfo());
    }
}

