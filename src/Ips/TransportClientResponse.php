<?php

namespace ctapu4ok\VkMessengerSdk\Ips;

class TransportClientResponse
{
    private ?int $http_status;

    private ?array $headers;

    private ?string $body;

    /**
     * TransportClientResponse constructor.
     *
     * @param int|null    $http_status
     * @param array|null  $headers
     * @param null|string $body
     */
    public function __construct(?int $http_status, ?array $headers, ?string $body)
    {
        $this->http_status = $http_status;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @return int|null
     */
    public function getHttpStatus(): ?int
    {
        return $this->http_status;
    }

    /**
     * @return array|null
     */
    public function getHeaders(): ?array
    {
        return $this->headers;
    }
}