<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiAuthFloodException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Auth implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Auth constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Allows to restore account access using a code received via SMS. " This method is only available for apps with [vk.com/dev/auth_direct|Direct authorization] access. "
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string phone: User phone number.
     * - @var string last_name: User last name.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAuthFloodException Too many auth attempts, try again later
     */
    public function restore(array $params = [])
    {
        return $this->request->post('auth.restore', $params);
    }
}

