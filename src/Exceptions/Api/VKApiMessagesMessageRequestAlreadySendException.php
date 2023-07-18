<?php
namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

/**
 */
class VKApiMessagesMessageRequestAlreadySendException extends VKApiException
{

    /**
     * VKApiMessagesMessageRequestAlreadySendException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VkApiError $error)
    {
        parent::__construct(939, 'Message request already send', $error);
    }
}
