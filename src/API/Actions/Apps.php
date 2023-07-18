<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\AppsFilter;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\AppsPlatform;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\AppsSort;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\AppsType;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Base\NameCase;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiActionFailedException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Apps implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Apps constructor.
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
     * - @var array[integer] user_ids
     * - @var integer group_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function addUsersToTestingGroup(array $params = [])
    {
        return $this->request->post('apps.addUsersToTestingGroup', $params);
    }


    /**
     * Deletes all request notifications from the current app.
     *
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function deleteAppRequests(string $access_token)
    {
        return $this->request->post('apps.deleteAppRequests', $access_token);
    }


    /**
     * Returns applications data.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer app_id: Application ID
     * - @var array[integer] app_ids: List of application ID
     * - @var AppsPlatform platform: platform. Possible values: *'ios' - iOS,, *'android' - Android,, *'winphone' - Windows Phone,, *'web' - приложения на vk.com. By default: 'web'.
     * - @var boolean extended
     * - @var boolean return_friends
     * - @var array[AppsFields] fields: Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'contacts', 'education', 'online', 'counters', 'relation', 'last_seen', 'activity', 'can_write_private_message', 'can_see_all_posts', 'can_post', 'universities', (only if return_friends - 1)
     * - @var NameCase name_case: Case for declension of user name and surname: 'nom' - nominative (default),, 'gen' - genitive,, 'dat' - dative,, 'acc' - accusative,, 'ins' - instrumental,, 'abl' - prepositional. (only if 'return_friends' = '1')
     * - @var array[AppsAppFields] app_fields: List of app fields to return. Fields 'id', 'type' and 'title' will always be in response. Leave this field empty to get all fields
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('apps.get', $params);
    }


    /**
     * Returns a list of applications (apps) available to users in the App Catalog.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var AppsSort sort: Sort order: 'popular_today' - popular for one day (default), 'visitors' - by visitors number , 'create_date' - by creation date, 'growth_rate' - by growth rate, 'popular_week' - popular for one week
     * - @var integer offset: Offset required to return a specific subset of apps.
     * - @var integer count: Number of apps to return.
     * - @var string platform
     * - @var boolean extended: '1' - to return additional fields 'screenshots', 'MAU', 'catalog_position', and 'international'. If set, 'count' must be less than or equal to '100'. '0' - not to return additional fields (default).
     * - @var boolean return_friends
     * - @var array[AppsFields] fields
     * - @var string name_case
     * - @var string q: Search query string.
     * - @var integer genre_id
     * - @var AppsFilter filter: 'installed' - to return list of installed apps (only for mobile platform).
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getCatalog(array $params = [])
    {
        return $this->request->post('apps.getCatalog', $params);
    }


    /**
     * Creates friends list for requests and invites in current app.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var boolean extended
     * - @var integer count: List size.
     * - @var integer offset
     * - @var AppsType type: List type. Possible values: * 'invite' - available for invites (don't play the game),, * 'request' - available for request (play the game). By default: 'invite'.
     * - @var array[AppsFields] fields: Additional profile fields, see [vk.com/dev/fields|description].
     * - @var string query: Search query string (e.g., 'Vasya Babich').
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getFriendsList(array $params = [])
    {
        return $this->request->post('apps.getFriendsList', $params);
    }


    /**
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     */
    public function getLastUploadedVersion(string $access_token)
    {
        return $this->request->post('apps.getLastUploadedVersion', $access_token);
    }


    /**
     * Returns players rating in the game.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var AppsType type: Leaderboard type. Possible values: *'level' - by level,, *'points' - by mission points,, *'score' - by score ().
     * - @var boolean global: Rating type. Possible values: *'1' - global rating among all players,, *'0' - rating among user friends.
     * - @var boolean extended: 1 - to return additional info about users
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getLeaderboard(array $params = [])
    {
        return $this->request->post('apps.getLeaderboard', $params);
    }


    /**
     * Returns policies and terms given to a mini app.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer app_id: Mini App ID
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getMiniAppPolicies(array $params = [])
    {
        return $this->request->post('apps.getMiniAppPolicies', $params);
    }


    /**
     * Returns scopes for auth
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var AppsType type
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getScopes(array $params = [])
    {
        return $this->request->post('apps.getScopes', $params);
    }


    /**
     * Returns user score in app
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getScore(array $params = [])
    {
        return $this->request->post('apps.getScore', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer group_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getTestingGroups(array $params = [])
    {
        return $this->request->post('apps.getTestingGroups', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function isNotificationsAllowed(array $params = [])
    {
        return $this->request->post('apps.isNotificationsAllowed', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer promo_id: Id of game promo action
     * - @var integer user_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiActionFailedException Unable to process action
     */
    public function promoHasActiveGift(array $params = [])
    {
        return $this->request->post('apps.promoHasActiveGift', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer promo_id: Id of game promo action
     * - @var integer user_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiActionFailedException Unable to process action
     */
    public function promoUseGift(array $params = [])
    {
        return $this->request->post('apps.promoUseGift', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer group_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function removeTestingGroup(array $params = [])
    {
        return $this->request->post('apps.removeTestingGroup', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] user_ids
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function removeUsersFromTestingGroups(array $params = [])
    {
        return $this->request->post('apps.removeUsersFromTestingGroups', $params);
    }


    /**
     * Sends a request to another user in an app that uses VK authorization.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id: id of the user to send a request
     * - @var string text: request text
     * - @var AppsType type: request type. Values: 'invite' - if the request is sent to a user who does not have the app installed,, 'request' - if a user has already installed the app
     * - @var string name
     * - @var string key: special string key to be sent with the request
     * - @var boolean separate
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function sendRequest(array $params = [])
    {
        return $this->request->post('apps.sendRequest', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer group_id
     * - @var string webview
     * - @var string name
     * - @var array[AppsPlatforms] platforms
     * - @var array[integer] user_ids
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function updateMetaForTestingGroup(array $params = [])
    {
        return $this->request->post('apps.updateMetaForTestingGroup', $params);
    }
}

