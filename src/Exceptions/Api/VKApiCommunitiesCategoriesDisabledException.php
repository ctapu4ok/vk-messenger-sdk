<?php
namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

/**
 */
class VKApiCommunitiesCategoriesDisabledException extends VKApiException
{

    /**
     * VKApiCommunitiesCategoriesDisabledException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VkApiError $error)
    {
        parent::__construct(1311, 'Catalog categories are not available for this user', $error);
    }
}
