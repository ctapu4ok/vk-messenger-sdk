<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiAdsLookalikeRequestExportAlreadyInProgressException extends VKApiException
{
    /**
     * VKApiAdsLookalikeRequestExportAlreadyInProgressException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(634, 'Lookalike request audience save already in progress', $error);
    }
}

