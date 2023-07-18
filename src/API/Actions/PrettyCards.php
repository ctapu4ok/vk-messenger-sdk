<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiPrettyCardsCardIsConnectedToPostException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiPrettyCardsCardNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiPrettyCardsTooManyCardsException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class PrettyCards implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * PrettyCards constructor.
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
     * - @var string photo
     * - @var string title
     * - @var string link
     * - @var string price
     * - @var string price_old
     * - @var string button
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiPrettyCardsTooManyCardsException Too many cards
     */
    public function create(array $params = [])
    {
        return $this->request->post('prettyCards.create', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var integer card_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiPrettyCardsCardNotFoundException Card not found
     * @throws VKApiPrettyCardsCardIsConnectedToPostException Card is connected to post
     */
    public function delete(array $params = [])
    {
        return $this->request->post('prettyCards.delete', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var integer card_id
     * - @var string photo
     * - @var string title
     * - @var string link
     * - @var string price
     * - @var string price_old
     * - @var string button
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiPrettyCardsCardNotFoundException Card not found
     */
    public function edit(array $params = [])
    {
        return $this->request->post('prettyCards.edit', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var integer offset
     * - @var integer count
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('prettyCards.get', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var array[integer] card_ids
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getById(array $params = [])
    {
        return $this->request->post('prettyCards.getById', $params);
    }


    /**
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getUploadURL(string $access_token)
    {
        return $this->request->post('prettyCards.getUploadURL', $access_token);
    }
}

