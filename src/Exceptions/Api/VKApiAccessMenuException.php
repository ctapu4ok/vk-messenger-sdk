<?php
namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

/**
 */
class VKApiAccessMenuException extends VKApiException
{

    /**
     * VKApiAccessMenuException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VkApiError $error)
    {
        parent::__construct(148, 'Access to the menu of the user denied', $error);
    }
}
