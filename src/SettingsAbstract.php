<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk;
class SettingsAbstract
{
    /**
     * Whether this setting was changed.
     */
    protected bool $changed = true;
    /**
     * Merge legacy settings array.
     *
     * @param    array $settings Settings array
     * @internal
     */
    public function mergeArray(array $settings): void
    {
    }

    public function __sleep()
    {
        $result = [];
        foreach ((new \ReflectionClass($this))->getProperties(\ReflectionProperty::IS_PROTECTED|\ReflectionProperty::IS_PUBLIC) as $property) {
            $result []= $property->getName();
        }
        return $result;
    }
}