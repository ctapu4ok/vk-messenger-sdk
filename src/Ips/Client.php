<?php

namespace ctapu4ok\VkMessengerSdk\Ips;

use Amp\DeferredFuture;
use Amp\Future;
use Amp\Mysql\MysqlConnectionPool;
use ctapu4ok\VkMessengerSdk\API\VKApiClient;
use ctapu4ok\VkMessengerSdk\APIWrapper;
use ctapu4ok\VkMessengerSdk\Database\Traits\DbInitializer;
use ctapu4ok\VkMessengerSdk\Interfaces\DatabaseInterface;
use ctapu4ok\VkMessengerSdk\Ips\Traits\Events;
use ctapu4ok\VkMessengerSdk\Ips\Traits\UpdateHandler;
use ctapu4ok\VkMessengerSdk\Logger;
use ctapu4ok\VkMessengerSdk\Settings;
use ctapu4ok\VkMessengerSdk\SettingsAbstract;
use ctapu4ok\VkMessengerSdk\Tools\Utilities;

final class Client
{
    use Events, UpdateHandler, DbInitializer;

    public APIWrapper $wrapper;

    public VKApiClient $vk;

    public Logger $logger;
    /**
     * @var DatabaseInterface|MysqlConnectionPool
     */
    public DatabaseInterface $db;
    public static array $references = [];
    private ?Future $initPromise = null;
    public Settings $settings;
    public function __construct(Settings $settings, ?APIWrapper $wrapper = null)
    {
        $this->wrapper = $wrapper;

        $this->settings = $settings;
        $initDeferred = new DeferredFuture;
        $this->initPromise = $initDeferred->getFuture();
        $this->wakeup($settings, $wrapper);
        $this->vk = new VKApiClient($settings);
        $initDeferred->complete();
    }

    public function start()
    {
    }

    public function startUpdateSystem(bool $anyway = false): void
    {
        $this->logger('The update system is running.');
        $UpdateLoop = new UpdateLoop($this);
        $UpdateLoop->loop();
    }

    public function logger(mixed $param, int $level = Logger::NOTICE, string $file = ''): void
    {
        ($this->logger ?? Logger::$default)->logger($param, $level, $file);
    }

    public function getLogger(): Logger
    {
        return $this->logger;
    }

    private function setupLogger(): void
    {
        $this->logger = new Logger(
            $this->settings->getLogger(),
            (string) ($this->settings->getAppInfo()->getGroupId() ?? ''),
        );
    }

    private function setupDatabase(Settings $settings): void
    {
        if ($settings->getDb() instanceof  DatabaseInterface) {
            $this->db = $this->initDb($this->wrapper, $settings);
        }
    }

    public function wakeup(Settings $settings, APIWrapper $wrapper)
    {
        Utilities::start(light: false);
        self::$references[\spl_object_hash($this)] = $this;
        $this->wrapper = $wrapper;
        $deferred = new DeferredFuture;
        $this->initPromise = $deferred->getFuture();
        $this->setupLogger();
        $this->setupDatabase($settings);
        $deferred->complete();
    }
}
