<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk\Settings;

use Closure;
use ctapu4ok\VkMessengerSdk\Exceptions\Exception;
use ctapu4ok\VkMessengerSdk\Logger as VkMessengerLogger;
use ctapu4ok\VkMessengerSdk\Tools\Utilities;
use function defined;
use function is_callable;
use function max;
use const PHP_SAPI;

class Logger
{
    protected int $type;

    /**
     * Extra parameter for logger.
     *
     * @var null|callable|string
     */
    protected $extra;

    /**
     * Logging level.
     *
     * @var VkMessengerLogger::LEVEL_*
     */
    protected int $level = VkMessengerLogger::LEVEL_VERBOSE;

    /**
     * Maximum filesize for logger, in case of file logging.
     */
    protected int $maxSize = 1 * 1024 * 1024;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->type = (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg')
            ? VkMessengerLogger::ECHO_LOGGER
            : VkMessengerLogger::FILE_LOGGER;
        Utilities::start(light: true);
        $this->extra = Utilities::$script_cwd . '/VKMessenger.log';
    }

    public function mergeArray(array $settings): void
    {
        if (!isset($settings['logger']['logger_param']) && isset($settings['logger']['param'])) {
            $settings['logger']['logger_param'] = $settings['logger']['param'];
        }
        if (PHP_SAPI !== 'cli' &&
            PHP_SAPI !== 'phpdbg' &&
            isset($settings['logger']['logger_param']) &&
            $settings['logger']['logger_param'] === 'VKMessenger.log'
        ) {
            $settings['logger']['logger_param'] = Utilities::$script_cwd . '/VKMessenger.log';
        }
        switch ($settings['logger']['logger_level'] ?? null) {
            case 'ULTRA_VERBOSE':
                $settings['logger']['logger_level'] = 5;
                break;
            case 'VERBOSE':
                $settings['logger']['logger_level'] = 4;
                break;
            case 'NOTICE':
                $settings['logger']['logger_level'] = 3;
                break;
            case 'WARNING':
                $settings['logger']['logger_level'] = 2;
                break;
            case 'ERROR':
                $settings['logger']['logger_level'] = 1;
                break;
            case 'FATAL ERROR':
                $settings['logger']['logger_level'] = 0;
                break;
        }
        if (isset($settings['logger']['logger'])) {
            $this->setType($settings['logger']['logger']);
        }
        if (isset($settings['logger']['logger_param'])) {
            $this->setExtra($settings['logger']['logger_param']);
        }
        if (isset($settings['logger']['logger_level'])) {
            $this->setLevel($settings['logger']['logger_level']);
        }
        if (isset($settings['logger']['max_size'])) {
            $this->setMaxSize($settings['logger']['max_size'] ?? 1 * 1024 * 1024);
        }

        $this->init();
    }

    /**
     * Initialize global logging.
     */
    private function init(): void
    {
        Utilities::start(light: true);
        VkMessengerLogger::constructorFromSettings($this);
    }

    public function __sleep()
    {
        return $this->extra instanceof Closure
            ? ['type', 'extra', 'level', 'maxSize']
            : ['type', 'level', 'maxSize'];
    }

    /**
     * Wakeup function.
     */
    public function __wakeup(): void
    {
        $this->type = (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg')
            ? VkMessengerLogger::ECHO_LOGGER
            : VkMessengerLogger::FILE_LOGGER;
        if (!$this->extra && $this->type === VkMessengerLogger::FILE_LOGGER) {
            $this->extra = Utilities::$script_cwd . '/VKMessenger.log';
        }

        $this->init();
    }

    /**
     * Get $type Logger type.
     *
     * @return VkMessengerLogger::LOGGER_*
     */
    public function getType(): int
    {
        return defined('MADELINE_WORKER') ? VkMessengerLogger::FILE_LOGGER : $this->type;
    }

    /**
     * Set $type Logger type.
     *
     * @param int $type $type Logger type.
     * @return Logger
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get extra parameter for logger.
     *
     */
    public function getExtra(): callable|string|null
    {
        return $this->type === VkMessengerLogger::FILE_LOGGER
            ? Utilities::absolute($this->extra)
            : $this->extra;
    }

    /**
     * Set extra parameter for logger.
     *
     * @param null|callable|string $extra Extra parameter for logger.
     */
    public function setExtra(callable|string|null $extra): self
    {
        if ($this->type === VkMessengerLogger::CALLABLE_LOGGER && !is_callable($extra)) {
            $this->setType((PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg')
                ? VkMessengerLogger::ECHO_LOGGER
                : VkMessengerLogger::FILE_LOGGER);
            return $this;
        }
        $this->extra = $extra;

        return $this;
    }

    /**
     * Get logging level.
     *
     * @return VkMessengerLogger::LEVEL_*
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * Set logging level.
     *
     * @param int $level Logging level.
     * @return Logger
     */
    public function setLevel(int $level): self
    {
        $this->level = max($level, VkMessengerLogger::NOTICE);

        return $this;
    }

    /**
     * Get maximum filesize for logger, in case of file logging.
     */
    public function getMaxSize(): int
    {
        return $this->maxSize;
    }

    /**
     * Set maximum filesize for logger, in case of file logging.
     *
     * @param int $maxSize Maximum filesize for logger, in case of file logging.
     */
    public function setMaxSize(int $maxSize): self
    {
        $this->maxSize = $maxSize === -1 ? $maxSize : max($maxSize, 25 * 1024 * 1024);

        return $this;
    }
}
