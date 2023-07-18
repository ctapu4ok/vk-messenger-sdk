<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiLimitsException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Storage implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Storage constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Returns a value of variable with the name set by key parameter.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string key
     * - @var array[string] keys
     * - @var integer user_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('storage.get', $params);
    }


    /**
     * Returns the names of all variables.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id: user id, whose variables names are returned if they were requested with a server method.
     * - @var integer offset
     * - @var integer count: amount of variable names the info needs to be collected from.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getKeys(array $params = [])
    {
        return $this->request->post('storage.getKeys', $params);
    }


    /**
     * Saves a value of variable with the name set by 'key' parameter.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string key
     * - @var string value
     * - @var integer user_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiLimitsException Out of limits
     */
    public function set(array $params = [])
    {
        return $this->request->post('storage.set', $params);
    }
}

