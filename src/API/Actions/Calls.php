<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Calls implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Calls constructor.
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
     * - @var string call_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function forceFinish(array $params = [])
    {
        return $this->request->post('calls.forceFinish', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer group_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function start(array $params = [])
    {
        return $this->request->post('calls.start', $params);
    }
}

