<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMarketGroupingAlreadyHasSuchVariantException extends VKApiException
{
    /**
     * VKApiMarketGroupingAlreadyHasSuchVariantException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1413, 'Grouping already has such variant', $error);
    }
}

