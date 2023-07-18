<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiStatusNoAudioException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Status implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Status constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Returns data required to show the status of a user or community.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id: User ID or community ID. Use a negative value to designate a community ID.
     * - @var integer group_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('status.get', $params);
    }


    /**
     * Sets a new status for the current user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string text: Text of the new status.
     * - @var integer group_id: Identifier of a community to set a status in. If left blank the status is set to current user.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiStatusNoAudioException User disabled track name broadcast
     */
    public function set(array $params = [])
    {
        return $this->request->post('status.set', $params);
    }
}

