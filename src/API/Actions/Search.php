<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Search implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Search constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Allows the programmer to do a quick search for any substring.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string q: Search query string.
     * - @var integer offset: Offset for querying specific result subset
     * - @var integer limit: Maximum number of results to return.
     * - @var array[string] filters
     * - @var array[string] fields
     * - @var boolean search_global
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getHints(array $params = [])
    {
        return $this->request->post('search.getHints', $params);
    }
}

