<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Widgets implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Widgets constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Gets a list of comments for the page added through the [vk.com/dev/Comments|Comments widget].
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer widget_api_id
     * - @var string url
     * - @var string page_id
     * - @var string order
     * - @var array[WidgetsFields] fields
     * - @var integer offset
     * - @var integer count
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getComments(array $params = [])
    {
        return $this->request->post('widgets.getComments', $params);
    }


    /**
     * Gets a list of application/site pages where the [vk.com/dev/Comments|Comments widget] or [vk.com/dev/Like|Like widget] is installed.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer widget_api_id
     * - @var string order
     * - @var string period
     * - @var integer offset
     * - @var integer count
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getPages(array $params = [])
    {
        return $this->request->post('widgets.getPages', $params);
    }
}

