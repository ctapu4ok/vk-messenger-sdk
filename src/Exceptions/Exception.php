<?php

declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk\Exceptions;

use ctapu4ok\VkMessengerSdk\Exceptions\TL\PrettyException;
use ctapu4ok\VkMessengerSdk\Logger;
use ctapu4ok\VkMessengerSdk\Tools\Utilities;
use const DIRECTORY_SEPARATOR;
use const PHP_EOL;
use const PHP_MAJOR_VERSION;
use const PHP_MINOR_VERSION;
use const PHP_SAPI;

/**
 * Basic exception.
 */
final class Exception extends \Exception
{
    use PrettyException;
    public function __toString(): string
    {
        return $this->file === 'VkMessenger' ?
            $this->message :
            '\\ctapu4ok\\VkMessengerSdk\\Exceptions\\Exception'.($this->message !== '' ?
                ': ' :
                '').$this->message.' in '.$this->file.':'.$this->line.PHP_EOL.Utilities::$revision.PHP_EOL.'TL Trace:'.
            PHP_EOL.$this->getTLTrace();
    }
    public function __construct($message = null, $code = 0, ?self $previous = null, $file = null, $line = null)
    {
        $this->prettifyTL();
        if ($file !== null) {
            $this->file = $file;
        }
        if ($line !== null) {
            $this->line = $line;
        }
        parent::__construct($message, $code, $previous);
        if (\strpos($message, 'socket_accept') === false
            && !\in_array(\basename($this->file), ['PKCS8.php', 'PSS.php'])
        ) {
            Logger::log($message.' in '.\basename($this->file).':'.$this->line, Logger::FATAL_ERROR);
        }
    }
    /**
     * Complain about missing extensions.
     *
     * @param string $extensionName Extension name
     */
    public static function extension(string $extensionName): self
    {
        $additional = 'Try running sudo apt-get install php'.PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION.'-'.$extensionName.'.';
        if ($extensionName === 'libtgvoip') {
            $additional = 'Follow the instructions @ https://github.com/ctapu4ok/vk-messenger-sdk to install it.';
        } elseif ($extensionName === 'prime') {
            $additional = 'Follow the instructions @ https://github.com/ctapu4ok/vk-messenger-sdk to install it.';
        }
        $message = 'VkMessengerSDK requires the '.$extensionName.' extension to run. '.$additional;
        if (PHP_SAPI !== 'cli' && PHP_SAPI !== 'phpdbg') {
            echo $message.'<br>';
        }
        $file = 'VkMessengerSDK';
        $line = 1;
        return new self($message, 0, null, $file, $line);
    }
    /**
     * @internal
     *
     * Error handler
     */
    public static function exceptionErrorHandler($errno = 0, $errstr = null, $errfile = null, $errline = null): bool
    {
        $errfileReplaced = \preg_replace('/phabel-transpiler\d+\./', '', $errfile ?? '');
        // If error is suppressed with @, don't throw an exception
        if (\error_reporting() === 0
            || \strpos($errstr, 'headers already sent')
            || \strpos($errstr, 'Creation of dynamic property') !== false
            || \strpos($errstr, 'Legacy nullable type detected') !== false
            || $errfileReplaced && (
                \strpos($errfileReplaced, DIRECTORY_SEPARATOR.'amphp'.DIRECTORY_SEPARATOR) !== false
                || \strpos($errfileReplaced, DIRECTORY_SEPARATOR.'league'.DIRECTORY_SEPARATOR) !== false
                || \strpos($errfileReplaced, DIRECTORY_SEPARATOR.'phpseclib'.DIRECTORY_SEPARATOR) !== false
            )
        ) {
            return false;
        }
        throw new self($errstr, $errno, null, $errfile, $errline);
    }
    /**
     * @internal
     *
     * ExceptionErrorHandler.
     */
    public static function exceptionHandler(\Throwable $exception): void
    {
        if (\str_contains($exception->getMessage(), 'Fiber stack protect failed')
            || \str_contains($exception->getMessage(), 'Fiber stack allocate failed')
        ) {
            $maps = "";
            try {
                $maps = '~'.\substr_count(\file_get_contents('/proc/self/maps'), "\n");
                $pid = \getmypid();
                $maps = '~'.\substr_count(\file_get_contents("/proc/$pid/maps"), "\n");
            } catch (\Throwable) {
            }
            if ($maps !== '') {
                $maps = " ($maps)";
            }
        }
        Logger::log($exception, Logger::FATAL_ERROR);
        die(1);
    }
}
