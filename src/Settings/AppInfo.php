<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk\Settings;

use ctapu4ok\VkMessengerSdk\SettingsAbstract;

/**
 * App information
 */
class AppInfo extends SettingsAbstract
{

    /**
     * @var int|null Group id
     */
    protected ?int $groupId = 0;
    /**
     * @var string|null API hash
     */
    protected ?string $apiHash = null;
    /**
     * @var string|null Confirm string
     */
    protected ?string $confirmString = null;

    protected ?string $apiVersion = '';

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    /**
     * @param int|null $groupId
     */
    public function setGroupId(?int $groupId): void
    {
        $this->groupId = $groupId;
    }

    /**
     * @return string|null
     */
    public function getApiHash(): ?string
    {
        return $this->apiHash;
    }

    /**
     * @param string|null $apiHash
     */
    public function setApiHash(?string $apiHash): void
    {
        $this->apiHash = $apiHash;
    }

    /**
     * @return string|null
     */
    public function getConfirmString(): ?string
    {
        return $this->confirmString;
    }

    /**
     * @param string|null $confirmString
     */
    public function setConfirmString(?string $confirmString): void
    {
        $this->confirmString = $confirmString;
    }

    /**
     * @return string|null
     */
    public function getApiVersion(): ?string
    {
        return $this->apiVersion;
    }

    /**
     * @param string|null $apiVersion
     */
    public function setApiVersion(?string $apiVersion): void
    {
        $this->apiVersion = $apiVersion;
    }
}