<?php

namespace ctapu4ok\VkMessengerSdk;

use ctapu4ok\VkMessengerSdk\Ips\Client;

final class APIWrapper
{
    private Client $API;

    public function logger(mixed $param, int $level = Logger::NOTICE, string $file = ''): void
    {
        ($this->API->logger ?? Logger::$default)->logger($param, $level, $file);
    }

    /**
     * @return mixed
     */
    public function getAPI()
    {
        return $this->API;
    }

    /**
     * @param mixed $API
     */
    public function setAPI(Client $API): void
    {
        $this->API = $API;
    }

    public function __sleep(): array
    {
        return ['API'];
    }
}