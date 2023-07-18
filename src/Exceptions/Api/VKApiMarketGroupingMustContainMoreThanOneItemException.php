<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMarketGroupingMustContainMoreThanOneItemException extends VKApiException
{
    /**
     * VKApiMarketGroupingMustContainMoreThanOneItemException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(1425, 'Grouping must have two or more items', $error);
    }
}

