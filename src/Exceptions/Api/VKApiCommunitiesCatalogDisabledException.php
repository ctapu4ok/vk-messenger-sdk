<?php
namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

/**
 */
class VKApiCommunitiesCatalogDisabledException extends VKApiException
{

    /**
     * VKApiCommunitiesCatalogDisabledException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VkApiError $error)
    {
        parent::__construct(1310, 'Catalog is not available for this user', $error);
    }
}
