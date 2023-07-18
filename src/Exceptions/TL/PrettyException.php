<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk\Exceptions\TL;

use const PHP_EOL;
use const PHP_SAPI;

trait PrettyException
{
    /**
     * TL trace.
     *
     */
    public string $tlTrace = '';
    /**
     * Method name.
     *
     */
    private string $method = '';
    /**
     * Whether the TL trace was updated.
     *
     */
    private bool $updated = false;
    /**
     * Update TL trace.
     */
    public function updateTLTrace(array $trace): void
    {
        if (!$this->updated) {
            $this->updated = true;
            $this->prettifyTL($this->method, $trace);
        }
    }
    /**
     * Get TL trace.
     */
    public function getTLTrace(): string
    {
        return $this->tlTrace;
    }
    /**
     * Set TL trace.
     *
     * @param string $tlTrace TL trace
     */
    public function setTLTrace(string $tlTrace): void
    {
        $this->tlTrace = $tlTrace;
    }
    /**
     * Generate async trace.
     *
     * @param string $init  Method name
     * @param array  $trace Async trace
     */
    public function prettifyTL(string $init = '', ?array $trace = null): void
    {
        $this->method = $init;
        $previous_trace = $this->tlTrace;
        $this->tlTrace = '';
        $eol = PHP_EOL;
        if (PHP_SAPI !== 'cli' && PHP_SAPI !== 'phpdbg') {
            $eol = '<br>'.PHP_EOL;
        }
        $tl = false;
        foreach (\array_reverse($trace ?? $this->getTrace()) as $k => $frame) {
            if (isset($frame['function']) && \in_array($frame['function'], ['serializeParams', 'serializeObject'])) {
                if (($frame['args'][2] ?? '') !== '') {
                    $this->tlTrace .= $tl ? "['".$frame['args'][2]."']" : "While serializing:  \t".$frame['args'][2];
                    $tl = true;
                }
            } else {
                if ($tl) {
                    $this->tlTrace .= $eol;
                }
                if (isset($frame['function']) &&
                    ($frame['function'] === 'handle_rpc_error' &&
                        $k === \count($this->getTrace()) - 1) ||
                    $frame['function'] === 'unserialize'
                ) {
                    continue;
                }
                $this->tlTrace .= isset($frame['file']) ? \str_pad(\basename($frame['file']).'('.$frame['line'].'):', 20)."\t" : '';
                $this->tlTrace .= isset($frame['function']) ? $frame['function'].'(' : '';
                $this->tlTrace .= isset($frame['args']) ? \substr(\json_encode($frame['args']) ?: '', 1, -1) : '';
                $this->tlTrace .= ')';
                $this->tlTrace .= $eol;
                $tl = false;
            }
        }
        $this->tlTrace .= $init !== '' ? "['".$init."']" : '';
        $this->tlTrace = \implode($eol, \array_reverse(\explode($eol, $this->tlTrace)));
        if ($previous_trace) {
            $this->tlTrace .= $eol.$eol;
            $this->tlTrace .= "Previous TL trace:{$eol}";
            $this->tlTrace .= $previous_trace;
        }
    }
}
