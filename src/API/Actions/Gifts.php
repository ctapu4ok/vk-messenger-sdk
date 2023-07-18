<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Gifts implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Gifts constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Returns a list of user gifts.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id: User ID.
     * - @var integer count: Number of gifts to return.
     * - @var integer offset: Offset needed to return a specific subset of results.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('gifts.get', $params);
    }
}

