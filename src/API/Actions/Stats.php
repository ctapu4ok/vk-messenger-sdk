<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\StatsInterval;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiWallAccessPostException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Stats implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Stats constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Returns statistics of a community or an application.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer group_id: Community ID.
     * - @var integer app_id: Application ID.
     * - @var integer timestamp_from
     * - @var integer timestamp_to
     * - @var StatsInterval interval
     * - @var integer intervals_count
     * - @var array[string] filters
     * - @var array[string] stats_groups
     * - @var boolean extended
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('stats.get', $params);
    }


    /**
     * Returns stats for a wall post.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: post owner community id. Specify with "-" sign.
     * - @var array[integer] post_ids: wall posts id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiWallAccessPostException Access to wall's post denied
     */
    public function getPostReach(array $params = [])
    {
        return $this->request->post('stats.getPostReach', $params);
    }


    /**
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function trackVisitor(string $access_token)
    {
        return $this->request->post('stats.trackVisitor', $access_token);
    }
}

