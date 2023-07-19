<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk\Database\Traits;

use ctapu4ok\VkMessengerSdk\APIWrapper;
use ctapu4ok\VkMessengerSdk\Settings;
use Webmozart\Assert\InvalidArgumentException;
use function Amp\async;
use function Amp\Future\await;

trait DbInitializer
{
    private function initDb(APIWrapper $wrapper, Settings $settings)
    {
        $class = __NAMESPACE__;
        if (str_contains($class, '\Traits')) {
            $class = str_replace('\Traits', '', $class);
        }
        $dbSettingsCopy = clone $settings->getDb();

        switch (true) {
            case $dbSettingsCopy instanceof Settings\Database\Memory:
                $class .= '\\MemoryDriver';
                break;
            case $dbSettingsCopy instanceof Settings\Database\Mysql:
                $class .= '\\MysqlDriver';
                break;
            default:
                throw new InvalidArgumentException('Unknown dbType: ' . $dbSettingsCopy::class);
        }

        return $class::getInstance($dbSettingsCopy);
    }
}
