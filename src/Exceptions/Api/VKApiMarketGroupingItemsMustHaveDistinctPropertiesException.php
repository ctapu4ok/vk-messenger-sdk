<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMarketGroupingItemsMustHaveDistinctPropertiesException extends VKApiException
{
    /**
     * VKApiMarketGroupingItemsMustHaveDistinctPropertiesException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1426, 'Item must have distinct properties', $error);
    }
}

