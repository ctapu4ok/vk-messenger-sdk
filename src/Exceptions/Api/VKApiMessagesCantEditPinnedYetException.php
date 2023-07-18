<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions\Api;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;

class VKApiMessagesCantEditPinnedYetException extends VKApiException
{
    /**
     * VKApiMessagesCantEditPinnedYetException constructor.
     *
     * @param VkApiError $error
     */
    public function __construct(VKApiError $error)
    {
        parent::__construct(949, 'Can\'t edit pinned message yet', $error);
    }
}

