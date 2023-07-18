<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Donut implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Donut constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var integer offset
     * - @var integer count
     * - @var array[string] fields
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getFriends(array $params = [])
    {
        return $this->request->post('donut.getFriends', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     */
    public function getSubscription(array $params = [])
    {
        return $this->request->post('donut.getSubscription', $params);
    }


    /**
     * Returns a list of user's VK Donut subscriptions.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[DonutFields] fields
     * - @var integer offset
     * - @var integer count
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getSubscriptions(array $params = [])
    {
        return $this->request->post('donut.getSubscriptions', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function isDon(array $params = [])
    {
        return $this->request->post('donut.isDon', $params);
    }
}

