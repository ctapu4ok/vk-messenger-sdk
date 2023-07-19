<?php

namespace ctapu4ok\VkMessengerSdk\Tools;

use Amp\DeferredFuture;
use Amp\SignalException;
use ctapu4ok\VkMessengerSdk\APIWrapper;
use ctapu4ok\VkMessengerSdk\Exceptions\Exception;
use Revolt\EventLoop;
use Throwable;

use const DIRECTORY_SEPARATOR;
use const E_ALL;
use const PHP_INT_SIZE;

use const PHP_SAPI;
use const SIG_DFL;
use const SIGINT;
use const SIGTERM;
use function Amp\Log\hasColorSupport;

abstract class Utilities extends AsyncUtilities
{
    public static bool $can_getcwd = false;
    private static bool $inited = false;
    public static string $cwd;
    public static bool $isatty = false;
    private static bool $initedLight = false;
    public static string $script_cwd;
    public static string $revision;

    public static ?string $version;
    public static bool $hasOpenssl;
    public static ?string $version_latest;
    public static ?DeferredFuture $suspendPeriodicLogging = null;
    public static function getcwd(): string
    {
        return self::$can_getcwd ? \getcwd() : self::$cwd;
    }

    /**
     * @throws Exception
     */
    public static function start(bool $light): void
    {
        if (self::$inited || (self::$initedLight && $light)) {
            return;
        }
        if (PHP_INT_SIZE < 8) {
            throw new Exception(
                'A 64-bit build of PHP is required to run VkMessengerSDK, PHP 8.2+ recommended.',
                0,
                null,
                'VkMessengerSDK',
                1
            );
        }
        if (!\defined('AMP_WORKER')) {
            \define('AMP_WORKER', 1);
        }
        self::$revision = APIWrapper::RELEASE;

        if (!self::$initedLight) {
            \set_error_handler(Exception::exceptionErrorHandler(...));
            \set_exception_handler(Exception::exceptionHandler(...));
            $backtrace = \debug_backtrace(0);
            self::$script_cwd = self::$cwd = \dirname(\end($backtrace)['file']);
            if (PHP_SAPI !== 'cli' && PHP_SAPI !== 'phpdbg') {
                try {
                    \error_reporting(E_ALL);
                    \ini_set('log_errors', 1);
                    \ini_set('error_log', self::$script_cwd.DIRECTORY_SEPARATOR.'VkMessenger.log');
                } catch (Throwable $e) {
                }
            }
            try {
                \ini_set('memory_limit', -1);
            } catch (Throwable $e) {
            }
            try {
                self::$isatty = \defined('STDOUT') && hasColorSupport();
            } catch (Throwable $e) {
            }
            try {
                self::$cwd = \getcwd();
                self::$can_getcwd = true;
            } catch (Throwable $e) {
            }
            try {
                if (\function_exists('set_time_limit')) {
                    \set_time_limit(-1);
                }
            } catch (Throwable $e) {
            }
            if (\defined('SIGINT')) {
                try {
                    \pcntl_signal(SIGINT, fn () => null);
                    \pcntl_signal(SIGINT, SIG_DFL);
                    EventLoop::unreference(EventLoop::onSignal(SIGINT, static function (): void {
                        if (self::$suspendPeriodicLogging) {
                            self::togglePeriodicLogging();
                        }
                        throw new SignalException('SIGINT received');
                    }));
                    EventLoop::unreference(EventLoop::onSignal(SIGTERM, static function (): void {
                        if (self::$suspendPeriodicLogging) {
                            self::togglePeriodicLogging();
                        }
                        throw new SignalException('SIGTERM received');
                    }));
                } catch (Throwable $e) {
                }
            }
            self::$initedLight = true;
            if ($light) {
                return;
            }
        }
        foreach ([
                'json',
                'curl',
                'mbstring',
                'filter',
                'hash',
                'zlib'
            ] as $extension) {
            if (!\extension_loaded($extension)) {
                throw Exception::extension($extension);
            }
        }
        self::$hasOpenssl = \extension_loaded('openssl');
        self::$inited = true;
    }

    public static function togglePeriodicLogging(): void
    {
        if (self::$suspendPeriodicLogging) {
            $deferred = self::$suspendPeriodicLogging;
            self::$suspendPeriodicLogging = null;
            $deferred->complete();
        } else {
            self::$suspendPeriodicLogging = new DeferredFuture;
        }
    }


    public static function absolute(string $file): string
    {
        if (($file[0] ?? '') !== '/' && ($file[1] ?? '') !== ':' && !\in_array(\substr($file, 0, 4), ['phar', 'http'])) {
            $file = self::getcwd().DIRECTORY_SEPARATOR.$file;
        }
        return $file;
    }
}
