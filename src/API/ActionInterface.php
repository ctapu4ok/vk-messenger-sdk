<?php

namespace ctapu4ok\VkMessengerSdk\API;

use ctapu4ok\VkMessengerSdk\Ips\Request;

interface ActionInterface
{
    /**
     * @param Request $request
     */
    public function __construct(Request $request);
}
