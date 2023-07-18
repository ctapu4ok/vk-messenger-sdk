<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\LikesFilter;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\LikesFriendsOnly;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\LikesType;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiLikesReactionCanNotBeAppliedException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Likes implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Likes constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Adds the specified object to the 'Likes' list of the current user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var LikesType type: Object type: 'post' - post on user or community wall, 'comment' - comment on a wall post, 'photo' - photo, 'audio' - audio, 'video' - video, 'story' - story, 'note' - note, 'photo_comment' - comment on the photo, 'video_comment' - comment on the video, 'topic_comment' - comment in the discussion, 'sitepage' - page of the site where the [vk.com/dev/Like|Like widget] is installed
     * - @var integer owner_id: ID of the user or community that owns the object.
     * - @var integer item_id: Object ID.
     * - @var string access_key: Access key required for an object owned by a private entity.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiLikesReactionCanNotBeAppliedException Reaction can not be applied to the object
     */
    public function add(array $params = [])
    {
        return $this->request->post('likes.add', $params);
    }


    /**
     * Deletes the specified object from the 'Likes' list of the current user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var LikesType type: Object type: 'post' - post on user or community wall, 'comment' - comment on a wall post, 'photo' - photo, 'audio' - audio, 'video' - video, 'story' - story, 'note' - note, 'photo_comment' - comment on the photo, 'video_comment' - comment on the video, 'topic_comment' - comment in the discussion, 'sitepage' - page of the site where the [vk.com/dev/Like|Like widget] is installed
     * - @var integer owner_id: ID of the user or community that owns the object.
     * - @var integer item_id: Object ID.
     * - @var string access_key: Access key required for an object owned by a private entity.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function delete(array $params = [])
    {
        return $this->request->post('likes.delete', $params);
    }


    /**
     * Returns a list of IDs of users who added the specified object to their 'Likes' list.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var LikesType type: , Object type: 'post' - post on user or community wall, 'comment' - comment on a wall post, 'photo' - photo, 'audio' - audio, 'video' - video, 'story' - story, 'note' - note, 'photo_comment' - comment on the photo, 'video_comment' - comment on the video, 'topic_comment' - comment in the discussion, 'sitepage' - page of the site where the [vk.com/dev/Like|Like widget] is installed
     * - @var integer owner_id: ID of the user, community, or application that owns the object. If the 'type' parameter is set as 'sitepage', the application ID is passed as 'owner_id'. Use negative value for a community id. If the 'type' parameter is not set, the 'owner_id' is assumed to be either the current user or the same application ID as if the 'type' parameter was set to 'sitepage'.
     * - @var integer item_id: Object ID. If 'type' is set as 'sitepage', 'item_id' can include the 'page_id' parameter value used during initialization of the [vk.com/dev/Like|Like widget].
     * - @var string page_url: URL of the page where the [vk.com/dev/Like|Like widget] is installed. Used instead of the 'item_id' parameter.
     * - @var LikesFilter filter: Filters to apply: 'likes' - returns information about all users who liked the object (default), 'copies' - returns information only about users who told their friends about the object
     * - @var LikesFriendsOnly friends_only: Specifies which users are returned: '1' - to return only the current user's friends, '0' - to return all users (default)
     * - @var boolean extended: Specifies whether extended information will be returned. '1' - to return extended information about users and communities from the 'Likes' list, '0' - to return no additional information (default)
     * - @var integer offset: Offset needed to select a specific subset of users.
     * - @var integer count: Number of user IDs to return (maximum '1000'). Default is '100' if 'friends_only' is set to '0', otherwise, the default is '10' if 'friends_only' is set to '1'.
     * - @var boolean skip_own
     * - @var array[string] fields
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiLikesReactionCanNotBeAppliedException Reaction can not be applied to the object
     */
    public function getList(array $params = [])
    {
        return $this->request->post('likes.getList', $params);
    }


    /**
     * Checks for the object in the 'Likes' list of the specified user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id: User ID.
     * - @var LikesType type: Object type: 'post' - post on user or community wall, 'comment' - comment on a wall post, 'photo' - photo, 'audio' - audio, 'video' - video, 'story' - story, 'note' - note, 'photo_comment' - comment on the photo, 'video_comment' - comment on the video, 'topic_comment' - comment in the discussion
     * - @var integer owner_id: ID of the user or community that owns the object.
     * - @var integer item_id: Object ID.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function isLiked(array $params = [])
    {
        return $this->request->post('likes.isLiked', $params);
    }
}

