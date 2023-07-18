<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiActionFailedException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class DownloadedGames implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * DownloadedGames constructor.
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
     * - @var integer user_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiActionFailedException Unable to process action
     * @throws VKApiNotFoundException Not found
     */
    public function getPaidStatus(array $params = [])
    {
        return $this->request->post('downloadedGames.getPaidStatus', $params);
    }
}

