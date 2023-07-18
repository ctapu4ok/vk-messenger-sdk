<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\NotificationsSendingMode;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiGroupAppIsNotInstalledInCommunityException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Notifications implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Notifications constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Returns a list of notifications about other users' feedback to the current user's wall posts.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer count: Number of notifications to return.
     * - @var string start_from
     * - @var array[NotificationsFilters] filters: Type of notifications to return: 'wall' - wall posts, 'mentions' - mentions in wall posts, comments, or topics, 'comments' - comments to wall posts, photos, and videos, 'likes' - likes, 'reposted' - wall posts that are copied from the current user's wall, 'followers' - new followers, 'friends' - accepted friend requests
     * - @var integer start_time: Earliest timestamp (in Unix time) of a notification to return. By default, 24 hours ago.
     * - @var integer end_time: Latest timestamp (in Unix time) of a notification to return. By default, the current time.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('notifications.get', $params);
    }


    /**
     * Resets the counter of new notifications about other users' feedback to the current user's wall posts.
     *
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function markAsViewed(string $access_token)
    {
        return $this->request->post('notifications.markAsViewed', $access_token);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] user_ids
     * - @var string message
     * - @var string fragment
     * - @var integer group_id
     * - @var integer random_id
     * - @var NotificationsSendingMode sending_mode: Type of sending (delivering) notifications: 'immediately' - push and bell notifications will be delivered as soon as possible, 'delayed' - push and bell notifications will be delivered in the most comfortable time for the user, 'delayed_push' - only push notifications will be delivered in the most comfortable time, while the bell notifications will be delivered as soon as possible
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiGroupAppIsNotInstalledInCommunityException Application is not installed in community
     */
    public function sendMessage(array $params = [])
    {
        return $this->request->post('notifications.sendMessage', $params);
    }
}

