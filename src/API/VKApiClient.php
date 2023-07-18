<?php

namespace ctapu4ok\VkMessengerSdk\API;

use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Settings;

class VKApiClient
{
    protected const VK_API_ENDPOINT = 'https://api.vk.com/method';

    private Request $request;

    private array $instances = [];

    public function __construct(Settings $settings)
    {

        $this->request = new Request(
            $settings->getAppInfo()->getApiVersion(),
            self::VK_API_ENDPOINT,
            $language = '',
            $settings
        );
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param  string $name
     * @param  array  $_
     * @return mixed
     * @throws \Exception
     */
    public function __call(string $name, array $_)
    {
        $name = strtolower($name);
        $class = __NAMESPACE__ . "\\Actions\\" . ucfirst($name);
        if (!class_exists($class)) {
            throw new \Exception("Class " . $class . " not found");
        }

        if (!array_key_exists($name, $this->instances)) {
            $this->instances[$name] = new $class($this->request);
        }

        return $this->instances[$name];
    }
}
