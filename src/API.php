<?php

namespace ctapu4ok\VkMessengerSdk;

use ctapu4ok\VkMessengerSdk\Ips\Client;

class API extends AbstractAPI
{
    public function __construct(Settings $settings)
    {
        $this->wrapper = new APIWrapper();

        $this->wrapper->setAPI(new Client($settings, $this->wrapper));
    }
    protected function reconnectFull(): bool
    {
        return true;
    }


}
