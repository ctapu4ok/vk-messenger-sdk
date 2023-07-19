<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk\Settings\Database;

use ctapu4ok\VkMessengerSdk\Interfaces\DatabaseInterface;

class NoSqlDriverAbstract implements DatabaseInterface
{
    protected string $password;

    public function getDatabase(): string|int
    {
        // TODO: Implement getDatabase() method.
    }

    public function getUri(): string
    {
        // TODO: Implement getUri() method.
    }

    public function setUri(string $uri): static
    {
        // TODO: Implement setUri() method.
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUsername(): string
    {
        // TODO: Implement getUsername() method.
    }

}
