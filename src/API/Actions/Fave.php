<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\FaveItemType;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\FavePosition;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\FaveType;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiFaveAliexpressTagException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiLimitsException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Fave implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Fave constructor.
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
     * - @var string url
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     */
    public function addArticle(array $params = [])
    {
        return $this->request->post('fave.addArticle', $params);
    }


    /**
     * Adds a link to user faves.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string link: Link URL.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function addLink(array $params = [])
    {
        return $this->request->post('fave.addLink', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * - @var integer group_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function addPage(array $params = [])
    {
        return $this->request->post('fave.addPage', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var integer id
     * - @var string access_key
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function addPost(array $params = [])
    {
        return $this->request->post('fave.addPost', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var integer id
     * - @var string access_key
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function addProduct(array $params = [])
    {
        return $this->request->post('fave.addProduct', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var string name
     * - @var FavePosition position
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiLimitsException Out of limits
     */
    public function addTag(array $params = [])
    {
        return $this->request->post('fave.addTag', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var integer id
     * - @var string access_key
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function addVideo(array $params = [])
    {
        return $this->request->post('fave.addVideo', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer id
     * - @var string name
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function editTag(array $params = [])
    {
        return $this->request->post('fave.editTag', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var boolean extended: '1' - to return additional 'wall', 'profiles', and 'groups' fields. By default: '0'.
     * - @var FaveItemType item_type
     * - @var integer tag_id: Tag ID.
     * - @var integer offset: Offset needed to return a specific subset of users.
     * - @var integer count: Number of users to return.
     * - @var string fields
     * - @var boolean is_from_snackbar
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('fave.get', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer offset
     * - @var integer count
     * - @var FaveType type
     * - @var array[FaveFields] fields
     * - @var integer tag_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getPages(array $params = [])
    {
        return $this->request->post('fave.getPages', $params);
    }


    /**
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getTags(string $access_token)
    {
        return $this->request->post('fave.getTags', $access_token);
    }


    /**
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function markSeen(string $access_token)
    {
        return $this->request->post('fave.markSeen', $access_token);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var integer article_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function removeArticle(array $params = [])
    {
        return $this->request->post('fave.removeArticle', $params);
    }


    /**
     * Removes link from the user's faves.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string link_id: Link ID (can be obtained by [vk.com/dev/faves.getLinks|faves.getLinks] method).
     * - @var string link: Link URL
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function removeLink(array $params = [])
    {
        return $this->request->post('fave.removeLink', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * - @var integer group_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function removePage(array $params = [])
    {
        return $this->request->post('fave.removePage', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var integer id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function removePost(array $params = [])
    {
        return $this->request->post('fave.removePost', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var integer id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function removeProduct(array $params = [])
    {
        return $this->request->post('fave.removeProduct', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function removeTag(array $params = [])
    {
        return $this->request->post('fave.removeTag', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * - @var integer id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function removeVideo(array $params = [])
    {
        return $this->request->post('fave.removeVideo', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] ids
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function reorderTags(array $params = [])
    {
        return $this->request->post('fave.reorderTags', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * - @var integer group_id
     * - @var array[integer] tag_ids
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     */
    public function setPageTags(array $params = [])
    {
        return $this->request->post('fave.setPageTags', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var FaveItemType item_type
     * - @var integer item_owner_id
     * - @var integer item_id
     * - @var array[integer] tag_ids
     * - @var string link_id
     * - @var string link_url
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @throws VKApiFaveAliexpressTagException Can't set AliExpress tag to this type of object
     */
    public function setTags(array $params = [])
    {
        return $this->request->post('fave.setTags', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * - @var integer group_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function trackPageInteraction(array $params = [])
    {
        return $this->request->post('fave.trackPageInteraction', $params);
    }
}

