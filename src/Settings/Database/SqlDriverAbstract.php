<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk\Settings\Database;

class SqlDriverAbstract extends NoSqlDriverAbstract
{
    protected string $database = 'vk_messenger';

    protected string $username = 'root';
    protected string $uri = 'tcp://127.0.0.1';

    protected int $maxConnections = 100;

    protected int $timeout = 60;

    /**
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->database;
    }

    /**
     * @param string $database
     */
    public function setDatabase(string $database): static
    {
        $this->database = $database;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): static
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxConnections(): int
    {
        return $this->maxConnections;
    }

    /**
     * @param int $maxConnections
     */
    public function setMaxConnections(int $maxConnections): static
    {
        $this->maxConnections = $maxConnections;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout(int $timeout): static
    {
        $this->timeout = $timeout;
        return $this;
    }

}