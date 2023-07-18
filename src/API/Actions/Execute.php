<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiCompileException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Execute implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Execute constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiCompileException Unable to compile code
     */
    public function execute(string $access_token)
    {
        return $this->request->post('execute.execute', $access_token);
    }
}

