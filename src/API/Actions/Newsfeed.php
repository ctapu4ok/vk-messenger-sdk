<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Base\NameCase;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\NewsfeedType;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Newsfeed\IgnoreItemType;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiTooManyListsException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Newsfeed implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Newsfeed constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Prevents news from specified users and communities from appearing in the current user's newsfeed.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] user_ids
     * - @var array[integer] group_ids
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function addBan(array $params = [])
    {
        return $this->request->post('newsfeed.addBan', $params);
    }


    /**
     * Allows news from previously banned users and communities to be shown in the current user's newsfeed.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] user_ids
     * - @var array[integer] group_ids
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function deleteBan(array $params = [])
    {
        return $this->request->post('newsfeed.deleteBan', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer list_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function deleteList(array $params = [])
    {
        return $this->request->post('newsfeed.deleteList', $params);
    }


    /**
     * Returns data required to show newsfeed for the current user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[NewsfeedFilters] filters: Filters to apply: 'post' - new wall posts, 'photo' - new photos, 'photo_tag' - new photo tags, 'wall_photo' - new wall photos, 'friend' - new friends
     * - @var boolean return_banned: '1' - to return news items from banned sources
     * - @var integer start_time: Earliest timestamp (in Unix time) of a news item to return. By default, 24 hours ago.
     * - @var integer end_time: Latest timestamp (in Unix time) of a news item to return. By default, the current time.
     * - @var integer max_photos: Maximum number of photos to return. By default, '5'.
     * - @var string source_ids: Sources to obtain news from, separated by commas. User IDs can be specified in formats '' or 'u' , where '' is the user's friend ID. Community IDs can be specified in formats '-' or 'g' , where '' is the community ID. If the parameter is not set, all of the user's friends and communities are returned, except for banned sources, which can be obtained with the [vk.com/dev/newsfeed.getBanned|newsfeed.getBanned] method.
     * - @var string start_from: identifier required to get the next page of results. Value for this parameter is returned in 'next_from' field in a reply.
     * - @var integer count: Number of news items to return (default 50, maximum 100). For auto feed, you can use the 'new_offset' parameter returned by this method.
     * - @var array[NewsfeedFields] fields: Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
     * - @var string section
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('newsfeed.get', $params);
    }


    /**
     * Returns a list of users and communities banned from the current user's newsfeed.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var boolean extended: '1' - return extra information about users and communities
     * - @var array[NewsfeedFields] fields: Profile fields to return.
     * - @var NameCase name_case: Case for declension of user name and surname: 'nom' - nominative (default), 'gen' - genitive , 'dat' - dative, 'acc' - accusative , 'ins' - instrumental , 'abl' - prepositional
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getBanned(array $params = [])
    {
        return $this->request->post('newsfeed.getBanned', $params);
    }


    /**
     * Returns a list of comments in the current user's newsfeed.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer count: Number of comments to return. For auto feed, you can use the 'new_offset' parameter returned by this method.
     * - @var array[NewsfeedFilters] filters: Filters to apply: 'post' - new comments on wall posts, 'photo' - new comments on photos, 'video' - new comments on videos, 'topic' - new comments on discussions, 'note' - new comments on notes,
     * - @var string reposts: Object ID, comments on repost of which shall be returned, e.g. 'wall1_45486'. (If the parameter is set, the 'filters' parameter is optional.),
     * - @var integer start_time: Earliest timestamp (in Unix time) of a comment to return. By default, 24 hours ago.
     * - @var integer end_time: Latest timestamp (in Unix time) of a comment to return. By default, the current time.
     * - @var integer last_comments_count
     * - @var string start_from: Identificator needed to return the next page with results. Value for this parameter returns in 'next_from' field.
     * - @var array[NewsfeedFields] fields: Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getComments(array $params = [])
    {
        return $this->request->post('newsfeed.getComments', $params);
    }


    /**
     * Returns a list of newsfeeds followed by the current user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] list_ids: numeric list identifiers.
     * - @var boolean extended: Return additional list info
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getLists(array $params = [])
    {
        return $this->request->post('newsfeed.getLists', $params);
    }


    /**
     * Returns a list of posts on user walls in which the current user is mentioned.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: Owner ID.
     * - @var integer start_time: Earliest timestamp (in Unix time) of a post to return. By default, 24 hours ago.
     * - @var integer end_time: Latest timestamp (in Unix time) of a post to return. By default, the current time.
     * - @var integer offset: Offset needed to return a specific subset of posts.
     * - @var integer count: Number of posts to return.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getMentions(array $params = [])
    {
        return $this->request->post('newsfeed.getMentions', $params);
    }


    /**
     * , Returns a list of newsfeeds recommended to the current user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer start_time: Earliest timestamp (in Unix time) of a news item to return. By default, 24 hours ago.
     * - @var integer end_time: Latest timestamp (in Unix time) of a news item to return. By default, the current time.
     * - @var integer max_photos: Maximum number of photos to return. By default, '5'.
     * - @var string start_from: 'new_from' value obtained in previous call.
     * - @var integer count: Number of news items to return.
     * - @var array[NewsfeedFields] fields: Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getRecommended(array $params = [])
    {
        return $this->request->post('newsfeed.getRecommended', $params);
    }


    /**
     * Returns communities and users that current user is suggested to follow.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer offset: offset required to choose a particular subset of communities or users.
     * - @var integer count: amount of communities or users to return.
     * - @var boolean shuffle: shuffle the returned list or not.
     * - @var array[NewsfeedFields] fields: list of extra fields to be returned. See available fields for [vk.com/dev/fields|users] and [vk.com/dev/fields_groups|communities].
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getSuggestedSources(array $params = [])
    {
        return $this->request->post('newsfeed.getSuggestedSources', $params);
    }


    /**
     * Hides an item from the newsfeed.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var IgnoreItemType type: Item type. Possible values: *'wall' - post on the wall,, *'tag' - tag on a photo,, *'profilephoto' - profile photo,, *'video' - video,, *'audio' - audio.
     * - @var integer owner_id: Item owner's identifier (user or community), "Note that community id must be negative. 'owner_id=1' - user , 'owner_id=-1' - community "
     * - @var integer item_id: Item identifier
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function ignoreItem(array $params = [])
    {
        return $this->request->post('newsfeed.ignoreItem', $params);
    }


    /**
     * Creates and edits user newsfeed lists
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer list_id: numeric list identifier (if not sent, will be set automatically).
     * - @var string title: list name.
     * - @var array[integer] source_ids: users and communities identifiers to be added to the list. Community identifiers must be negative numbers.
     * - @var boolean no_reposts: reposts display on and off ('1' is for off).
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiTooManyListsException Too many feed lists
     */
    public function saveList(array $params = [])
    {
        return $this->request->post('newsfeed.saveList', $params);
    }


    /**
     * Returns search results by statuses.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string q: Search query string (e.g., 'New Year').
     * - @var boolean extended: '1' - to return additional information about the user or community that placed the post.
     * - @var integer count: Number of posts to return.
     * - @var number latitude: Geographical latitude point (in degrees, -90 to 90) within which to search.
     * - @var number longitude: Geographical longitude point (in degrees, -180 to 180) within which to search.
     * - @var integer start_time: Earliest timestamp (in Unix time) of a news item to return. By default, 24 hours ago.
     * - @var integer end_time: Latest timestamp (in Unix time) of a news item to return. By default, the current time.
     * - @var string start_from
     * - @var array[NewsfeedFields] fields: Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function search(array $params = [])
    {
        return $this->request->post('newsfeed.search', $params);
    }


    /**
     * Returns a hidden item to the newsfeed.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var IgnoreItemType type: Item type. Possible values: *'wall' - post on the wall,, *'tag' - tag on a photo,, *'profilephoto' - profile photo,, *'video' - video,, *'audio' - audio.
     * - @var integer owner_id: Item owner's identifier (user or community), "Note that community id must be negative. 'owner_id=1' - user , 'owner_id=-1' - community "
     * - @var integer item_id: Item identifier
     * - @var string track_code: Track code of unignored item
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function unignoreItem(array $params = [])
    {
        return $this->request->post('newsfeed.unignoreItem', $params);
    }


    /**
     * Unsubscribes the current user from specified newsfeeds.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var NewsfeedType type: Type of object from which to unsubscribe: 'note' - note, 'photo' - photo, 'post' - post on user wall or community wall, 'topic' - topic, 'video' - video
     * - @var integer owner_id: Object owner ID.
     * - @var integer item_id: Object ID.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function unsubscribe(array $params = [])
    {
        return $this->request->post('newsfeed.unsubscribe', $params);
    }
}

