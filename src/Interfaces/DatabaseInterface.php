<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk\Interfaces;

interface DatabaseInterface
{
    public function getDatabase(): string|int;
    /**
     * Get database URI.
     */
    public function getUri(): string;

    /**
     * Set database URI.
     */
    public function setUri(string $uri): static;

    public function setPassword(string $password): static;

    public function getPassword(): string;

    public function getUsername(): string;
}