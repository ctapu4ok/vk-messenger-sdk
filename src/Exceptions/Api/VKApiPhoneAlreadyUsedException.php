<?php
namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

/**
 */
class VKApiPhoneAlreadyUsedException extends VKApiException
{

    /**
     * VKApiPhoneAlreadyUsedException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VkApiError $error)
    {
        parent::__construct(1004, 'This phone number is used by another user', $error);
    }
}
