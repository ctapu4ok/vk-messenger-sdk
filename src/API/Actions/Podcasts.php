<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Podcasts implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Podcasts constructor.
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
     * - @var string search_string
     * - @var integer offset
     * - @var integer count
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function searchPodcast(array $params = [])
    {
        return $this->request->post('podcasts.searchPodcast', $params);
    }
}

