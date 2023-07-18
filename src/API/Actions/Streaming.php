<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\StreamingInterval;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\StreamingMonthlyTier;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\StreamingType;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Streaming implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Streaming constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Allows to receive data for the connection to Streaming API.
     *
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getServerUrl(string $access_token)
    {
        return $this->request->post('streaming.getServerUrl', $access_token);
    }


    /**
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getSettings(string $access_token)
    {
        return $this->request->post('streaming.getSettings', $access_token);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var StreamingType type
     * - @var StreamingInterval interval
     * - @var integer start_time
     * - @var integer end_time
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getStats(array $params = [])
    {
        return $this->request->post('streaming.getStats', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var string word
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getStem(array $params = [])
    {
        return $this->request->post('streaming.getStem', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var StreamingMonthlyTier monthly_tier
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function setSettings(array $params = [])
    {
        return $this->request->post('streaming.setSettings', $params);
    }
}

