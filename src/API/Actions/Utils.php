<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\UtilsInterval;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\UtilsSource;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Utils implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Utils constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Checks whether a link is blocked in VK.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string url: Link to check (e.g., 'http://google.com').
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function checkLink(array $params = [])
    {
        return $this->request->post('utils.checkLink', $params);
    }


    /**
     * Deletes shortened link from user's list.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string key: Link key (characters after vk.cc/).
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function deleteFromLastShortened(array $params = [])
    {
        return $this->request->post('utils.deleteFromLastShortened', $params);
    }


    /**
     * Returns a list of user's shortened links.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer count: Number of links to return.
     * - @var integer offset: Offset needed to return a specific subset of links.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getLastShortenedLinks(array $params = [])
    {
        return $this->request->post('utils.getLastShortenedLinks', $params);
    }


    /**
     * Returns stats data for shortened link.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string key: Link key (characters after vk.cc/).
     * - @var UtilsSource source: Source of scope
     * - @var string access_key: Access key for private link stats.
     * - @var UtilsInterval interval: Interval.
     * - @var integer intervals_count: Number of intervals to return.
     * - @var boolean extended: 1 - to return extended stats data (sex, age, geo). 0 - to return views number only.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     */
    public function getLinkStats(array $params = [])
    {
        return $this->request->post('utils.getLinkStats', $params);
    }


    /**
     * Returns the current time of the VK server.
     *
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getServerTime(string $access_token)
    {
        return $this->request->post('utils.getServerTime', $access_token);
    }


    /**
     * Allows to receive a link shortened via vk.cc.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string url: URL to be shortened.
     * - @var boolean private: 1 - private stats, 0 - public stats.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getShortLink(array $params = [])
    {
        return $this->request->post('utils.getShortLink', $params);
    }


    /**
     * Detects a type of object (e.g., user, community, application) and its ID by screen name.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string screen_name: Screen name of the user, community (e.g., 'apiclub,' 'andrew', or 'rules_of_war'), or application.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function resolveScreenName(array $params = [])
    {
        return $this->request->post('utils.resolveScreenName', $params);
    }
}

