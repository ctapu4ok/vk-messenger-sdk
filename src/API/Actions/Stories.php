<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Stories\UploadLinkText;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiBlockedException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMessagesUserBlockedException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiStoryExpiredException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiStoryIncorrectReplyPrivacyException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Stories implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Stories constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Allows to hide stories from chosen sources from current user's feed.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] owners_ids: List of sources IDs
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function banOwner(array $params = [])
    {
        return $this->request->post('stories.banOwner', $params);
    }


    /**
     * Allows to delete story.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: Story owner's ID. Current user id is used by default.
     * - @var integer story_id: Story ID.
     * - @var array[string] stories
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function delete(array $params = [])
    {
        return $this->request->post('stories.delete', $params);
    }


    /**
     * Returns stories available for current user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: Owner ID.
     * - @var boolean extended: '1' - to return additional fields for users and communities. Default value is 0.
     * - @var array[StoriesFields] fields
     * - @var array[string] feed_item_ids
     * - @var boolean minimized
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('stories.get', $params);
    }


    /**
     * Returns list of sources hidden from current user's feed.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var boolean extended: '1' - to return additional fields for users and communities. Default value is 0.
     * - @var array[StoriesFields] fields: Additional fields to return
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getBanned(array $params = [])
    {
        return $this->request->post('stories.getBanned', $params);
    }


    /**
     * Returns story by its ID.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[string] stories: Stories IDs separated by commas. Use format {owner_id}+'_'+{story_id}, for example, 12345_54331.
     * - @var boolean extended: '1' - to return additional fields for users and communities. Default value is 0.
     * - @var array[StoriesFields] fields: Additional fields to return
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiStoryExpiredException Story has already expired
     */
    public function getById(array $params = [])
    {
        return $this->request->post('stories.getById', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var integer story_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getDetailedStats(array $params = [])
    {
        return $this->request->post('stories.getDetailedStats', $params);
    }


    /**
     * Returns URL for uploading a story with photo.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var boolean add_to_news: 1 - to add the story to friend's feed.
     * - @var array[integer] user_ids: List of users IDs who can see the story.
     * - @var string reply_to_story: ID of the story to reply with the current.
     * - @var UploadLinkText link_text: Link text (for community's stories only).
     * - @var string link_url: Link URL. Internal links on https://vk.com only.
     * - @var integer group_id: ID of the community to upload the story (should be verified or with the "fire" icon).
     * - @var string clickable_stickers
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiMessagesUserBlockedException Can't send messages for users from blacklist
     * @throws VKApiStoryIncorrectReplyPrivacyException Incorrect reply privacy
     * @throws VKApiBlockedException Content blocked
     */
    public function getPhotoUploadServer(array $params = [])
    {
        return $this->request->post('stories.getPhotoUploadServer', $params);
    }


    /**
     * Returns replies to the story.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: Story owner ID.
     * - @var integer story_id: Story ID.
     * - @var string access_key: Access key for the private object.
     * - @var boolean extended: '1' - to return additional fields for users and communities. Default value is 0.
     * - @var array[StoriesFields] fields: Additional fields to return
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getReplies(array $params = [])
    {
        return $this->request->post('stories.getReplies', $params);
    }


    /**
     * Returns stories available for current user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: Story owner ID.
     * - @var integer story_id: Story ID.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getStats(array $params = [])
    {
        return $this->request->post('stories.getStats', $params);
    }


    /**
     * Allows to receive URL for uploading story with video.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var boolean add_to_news: 1 - to add the story to friend's feed.
     * - @var array[integer] user_ids: List of users IDs who can see the story.
     * - @var string reply_to_story: ID of the story to reply with the current.
     * - @var UploadLinkText link_text: Link text (for community's stories only).
     * - @var string link_url: Link URL. Internal links on https://vk.com only.
     * - @var integer group_id: ID of the community to upload the story (should be verified or with the "fire" icon).
     * - @var string clickable_stickers
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiMessagesUserBlockedException Can't send messages for users from blacklist
     * @throws VKApiStoryIncorrectReplyPrivacyException Incorrect reply privacy
     * @throws VKApiBlockedException Content blocked
     */
    public function getVideoUploadServer(array $params = [])
    {
        return $this->request->post('stories.getVideoUploadServer', $params);
    }


    /**
     * Returns a list of story viewers.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: Story owner ID.
     * - @var integer story_id: Story ID.
     * - @var integer count: Maximum number of results.
     * - @var integer offset: Offset needed to return a specific subset of results.
     * - @var boolean extended: '1' - to return detailed information about photos
     * - @var array[StoriesFields] fields
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiStoryExpiredException Story has already expired
     */
    public function getViewers(array $params = [])
    {
        return $this->request->post('stories.getViewers', $params);
    }


    /**
     * Hides all replies in the last 24 hours from the user to current user's stories.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of the user whose replies should be hidden.
     * - @var integer group_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function hideAllReplies(array $params = [])
    {
        return $this->request->post('stories.hideAllReplies', $params);
    }


    /**
     * Hides the reply to the current user's story.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of the user whose replies should be hidden.
     * - @var integer story_id: Story ID.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function hideReply(array $params = [])
    {
        return $this->request->post('stories.hideReply', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var array[string] upload_results
     * - @var string upload_results_json
     * - @var boolean extended
     * - @var array[StoriesFields] fields
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function save(array $params = [])
    {
        return $this->request->post('stories.save', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var string q
     * - @var integer place_id
     * - @var number latitude
     * - @var number longitude
     * - @var integer radius
     * - @var integer mentioned_id
     * - @var integer count
     * - @var boolean extended
     * - @var array[StoriesFields] fields
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function search(array $params = [])
    {
        return $this->request->post('stories.search', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var string access_key
     * - @var string message
     * - @var boolean is_broadcast
     * - @var boolean is_anonymous
     * - @var boolean unseen_marker
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function sendInteraction(array $params = [])
    {
        return $this->request->post('stories.sendInteraction', $params);
    }


    /**
     * Allows to show stories from hidden sources in current user's feed.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] owners_ids: List of hidden sources to show stories from.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function unbanOwner(array $params = [])
    {
        return $this->request->post('stories.unbanOwner', $params);
    }
}

