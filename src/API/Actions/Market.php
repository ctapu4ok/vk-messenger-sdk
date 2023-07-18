<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\MarketPaymentStatus;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\MarketReason;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\MarketRev;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\MarketSort;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\MarketSortBy;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\MarketSortDirection;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\MarketType;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiAccessMarketException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketAlbumMainHiddenException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketAlbumNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketCantChangeVkpayStatusException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketCommentsClosedException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketExtendedNotEnabledException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketGroupingAlreadyHasSuchVariantException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketGroupingItemsMustHaveDistinctPropertiesException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketGroupingItemsWithDifferentPropertiesException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketGroupingMustContainMoreThanOneItemException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketInvalidDimensionsException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketItemAlreadyAddedException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketItemHasBadLinksException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketItemNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketNotEnabledException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketOrdersInvalidStatusException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketOrdersNoCartItemsException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketPhotosCropInvalidFormatException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketPhotosCropOverflowException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketPhotosCropSizeTooLowException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketPropertyNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketRestoreTooLateException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketTooManyAlbumsException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketTooManyItemsException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketTooManyItemsInAlbumException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketVariantNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Market implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Market constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Ads a new item to the market.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var string name: Item name.
     * - @var string description: Item description.
     * - @var integer category_id: Item category ID.
     * - @var number price: Item price.
     * - @var number old_price
     * - @var boolean deleted: Item status ('1' - deleted, '0' - not deleted).
     * - @var integer main_photo_id: Cover photo ID.
     * - @var array[integer] photo_ids: IDs of additional photos.
     * - @var array[integer] video_ids: IDs of additional videos.
     * - @var string url: Url for button in market item.
     * - @var integer dimension_width
     * - @var integer dimension_height
     * - @var integer dimension_length
     * - @var integer weight
     * - @var string sku
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessMarketException Access denied
     * @throws VKApiMarketTooManyItemsException Too many items
     * @throws VKApiMarketItemHasBadLinksException Item has bad links in description
     * @throws VKApiMarketVariantNotFoundException Variant not found
     * @throws VKApiMarketPropertyNotFoundException Property not found
     * @throws VKApiMarketGroupingItemsMustHaveDistinctPropertiesException Item must have distinct properties
     * @throws VKApiMarketGroupingMustContainMoreThanOneItemException Grouping must have two or more items
     * @throws VKApiMarketPhotosCropInvalidFormatException Invalid image crop format
     * @throws VKApiMarketPhotosCropOverflowException Crop bottom right corner is outside of the image
     * @throws VKApiMarketPhotosCropSizeTooLowException Crop size is less than the minimum
     * @throws VKApiMarketNotEnabledException Market not enabled
     */
    public function add(array $params = [])
    {
        return $this->request->post('market.add', $params);
    }


    /**
     * Creates new collection of items
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var string title: Collection title.
     * - @var integer photo_id: Cover photo ID.
     * - @var boolean main_album: Set as main ('1' - set, '0' - no).
     * - @var boolean is_hidden: Set as hidden
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiMarketTooManyAlbumsException Too many albums
     * @throws VKApiMarketNotEnabledException Market not enabled
     * @throws VKApiMarketAlbumMainHiddenException Main album can not be hidden
     */
    public function addAlbum(array $params = [])
    {
        return $this->request->post('market.addAlbum', $params);
    }


    /**
     * Adds an item to one or multiple collections.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var array[integer] item_ids
     * - @var array[integer] album_ids: Collections IDs to add item to.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiMarketAlbumNotFoundException Album not found
     * @throws VKApiMarketNotEnabledException Market not enabled
     * @throws VKApiMarketItemNotFoundException Item not found
     * @throws VKApiMarketTooManyItemsInAlbumException Too many items in album
     * @throws VKApiMarketItemAlreadyAddedException Item already added to album
     */
    public function addToAlbum(array $params = [])
    {
        return $this->request->post('market.addToAlbum', $params);
    }


    /**
     * Creates a new comment for an item.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var integer item_id: Item ID.
     * - @var string message: Comment text (required if 'attachments' parameter is not specified)
     * - @var array[string] attachments: Comma-separated list of objects attached to a comment. The field is submitted the following way: , "'<owner_id>_<media_id>,<owner_id>_<media_id>'", , '' - media attachment type: "'photo' - photo, 'video' - video, 'audio' - audio, 'doc' - document", , '<owner_id>' - media owner id, '<media_id>' - media attachment id, , For example: "photo100172_166443618,photo66748_265827614",
     * - @var boolean from_group: '1' - comment will be published on behalf of a community, '0' - on behalf of a user (by default).
     * - @var integer reply_to_comment: ID of a comment to reply with current comment to.
     * - @var integer sticker_id: Sticker ID.
     * - @var string guid: Random value to avoid resending one comment.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function createComment(array $params = [])
    {
        return $this->request->post('market.createComment', $params);
    }


    /**
     * Deletes an item.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var integer item_id: Item ID.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessMarketException Access denied
     * @throws VKApiMarketNotEnabledException Market not enabled
     * @throws VKApiMarketItemNotFoundException Item not found
     */
    public function delete(array $params = [])
    {
        return $this->request->post('market.delete', $params);
    }


    /**
     * Deletes a collection of items.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an collection owner community.
     * - @var integer album_id: Collection ID.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiMarketAlbumNotFoundException Album not found
     * @throws VKApiMarketNotEnabledException Market not enabled
     */
    public function deleteAlbum(array $params = [])
    {
        return $this->request->post('market.deleteAlbum', $params);
    }


    /**
     * Deletes an item's comment
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: identifier of an item owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
     * - @var integer comment_id: comment id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function deleteComment(array $params = [])
    {
        return $this->request->post('market.deleteComment', $params);
    }


    /**
     * Edits an item.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var integer item_id: Item ID.
     * - @var string name: Item name.
     * - @var string description: Item description.
     * - @var integer category_id: Item category ID.
     * - @var number price: Item price.
     * - @var number old_price
     * - @var boolean deleted: Item status ('1' - deleted, '0' - not deleted).
     * - @var integer main_photo_id: Cover photo ID.
     * - @var array[integer] photo_ids: IDs of additional photos.
     * - @var array[integer] video_ids: IDs of additional videos.
     * - @var string url: Url for button in market item.
     * - @var integer dimension_width
     * - @var integer dimension_height
     * - @var integer dimension_length
     * - @var integer weight
     * - @var string sku
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessMarketException Access denied
     * @throws VKApiMarketItemNotFoundException Item not found
     * @throws VKApiMarketItemHasBadLinksException Item has bad links in description
     * @throws VKApiMarketGroupingItemsWithDifferentPropertiesException Grouping items with different properties
     * @throws VKApiMarketGroupingAlreadyHasSuchVariantException Grouping already has such variant
     * @throws VKApiMarketPhotosCropInvalidFormatException Invalid image crop format
     * @throws VKApiMarketPhotosCropOverflowException Crop bottom right corner is outside of the image
     * @throws VKApiMarketPhotosCropSizeTooLowException Crop size is less than the minimum
     * @throws VKApiMarketNotEnabledException Market not enabled
     */
    public function edit(array $params = [])
    {
        return $this->request->post('market.edit', $params);
    }


    /**
     * Edits a collection of items
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an collection owner community.
     * - @var integer album_id: Collection ID.
     * - @var string title: Collection title.
     * - @var integer photo_id: Cover photo id
     * - @var boolean main_album: Set as main ('1' - set, '0' - no).
     * - @var boolean is_hidden: Set as hidden
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiMarketAlbumNotFoundException Album not found
     * @throws VKApiMarketNotEnabledException Market not enabled
     * @throws VKApiMarketAlbumMainHiddenException Main album can not be hidden
     */
    public function editAlbum(array $params = [])
    {
        return $this->request->post('market.editAlbum', $params);
    }


    /**
     * Chages item comment's text
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var integer comment_id: Comment ID.
     * - @var string message: New comment text (required if 'attachments' are not specified), , 2048 symbols maximum.
     * - @var array[string] attachments: Comma-separated list of objects attached to a comment. The field is submitted the following way: , "'<owner_id>_<media_id>,<owner_id>_<media_id>'", , '' - media attachment type: "'photo' - photo, 'video' - video, 'audio' - audio, 'doc' - document", , '<owner_id>' - media owner id, '<media_id>' - media attachment id, , For example: "photo100172_166443618,photo66748_265827614",
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function editComment(array $params = [])
    {
        return $this->request->post('market.editComment', $params);
    }


    /**
     * Edit order
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * - @var integer order_id
     * - @var string merchant_comment
     * - @var integer status
     * - @var string track_number
     * - @var MarketPaymentStatus payment_status
     * - @var integer delivery_price
     * - @var integer width
     * - @var integer length
     * - @var integer height
     * - @var integer weight
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiMarketOrdersNoCartItemsException Cart is empty
     * @throws VKApiMarketInvalidDimensionsException Specify width, length, height and weight all together
     * @throws VKApiMarketCantChangeVkpayStatusException VK Pay status can not be changed
     * @throws VKApiMarketOrdersInvalidStatusException Order status is invalid
     */
    public function editOrder(array $params = [])
    {
        return $this->request->post('market.editOrder', $params);
    }


    /**
     * Returns a filter list of market categories.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer category_id: Category_id filter categories
     * - @var string query: Query filter categories
     * - @var integer count: Number of results to return.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function filterCategories(array $params = [])
    {
        return $this->request->post('market.filterCategories', $params);
    }


    /**
     * Returns items list for a community.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
     * - @var integer album_id
     * - @var integer count: Number of items to return.
     * - @var integer offset: Offset needed to return a specific subset of results.
     * - @var boolean extended: '1' - method will return additional fields: 'likes, can_comment, car_repost, photos'. These parameters are not returned by default.
     * - @var string date_from: Items update date from (format: yyyy-mm-dd)
     * - @var string date_to: Items update date to (format: yyyy-mm-dd)
     * - @var boolean need_variants: Add variants to response if exist
     * - @var boolean with_disabled: Add disabled items to response
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('market.get', $params);
    }


    /**
     * Returns items album's data
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: identifier of an album owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
     * - @var array[integer] album_ids: collections identifiers to obtain data from
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getAlbumById(array $params = [])
    {
        return $this->request->post('market.getAlbumById', $params);
    }


    /**
     * Returns community's market collections list.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an items owner community.
     * - @var integer offset: Offset needed to return a specific subset of results.
     * - @var integer count: Number of items to return.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getAlbums(array $params = [])
    {
        return $this->request->post('market.getAlbums', $params);
    }


    /**
     * Returns information about market items by their ids.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[string] item_ids: Comma-separated ids list: {user id}_{item id}. If an item belongs to a community -{community id} is used. " 'Videos' value example: , '-4363_136089719,13245770_137352259'"
     * - @var boolean extended: '1' - to return additional fields: 'likes, can_comment, car_repost, photos'. By default: '0'.
     * - @var string ref_screen: Ref screen
     * - @var string ref_post_id: Ref post id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getById(array $params = [])
    {
        return $this->request->post('market.getById', $params);
    }


    /**
     * Returns a list of market categories.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var MarketType type: Type of categories
     * - @var integer group_id: Group Id.
     * - @var integer count: Number of results to return.
     * - @var integer offset: Offset needed to return a specific subset of results.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getCategories(array $params = [])
    {
        return $this->request->post('market.getCategories', $params);
    }


    /**
     * Returns comments list for an item.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community
     * - @var integer item_id: Item ID.
     * - @var boolean need_likes: '1' - to return likes info.
     * - @var integer start_comment_id: ID of a comment to start a list from (details below).
     * - @var integer offset
     * - @var integer count: Number of results to return.
     * - @var MarketSort sort: Sort order ('asc' - from old to new, 'desc' - from new to old)
     * - @var boolean extended: '1' - comments will be returned as numbered objects, in addition lists of 'profiles' and 'groups' objects will be returned.
     * - @var array[MarketFields] fields: List of additional profile fields to return. See the [vk.com/dev/fields|details]
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiMarketCommentsClosedException Comments for this market are closed
     */
    public function getComments(array $params = [])
    {
        return $this->request->post('market.getComments', $params);
    }


    /**
     * Get market orders
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer|string group_id: ID or groups domain
     * - @var integer offset
     * - @var integer count
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiMarketExtendedNotEnabledException Extended market not enabled
     * @throws VKApiMarketOrdersInvalidStatusException Order status is invalid
     */
    public function getGroupOrders(array $params = [])
    {
        return $this->request->post('market.getGroupOrders', $params);
    }


    /**
     * Get order
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * - @var integer order_id
     * - @var boolean extended
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getOrderById(array $params = [])
    {
        return $this->request->post('market.getOrderById', $params);
    }


    /**
     * Get market items in the order
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * - @var integer order_id
     * - @var integer offset
     * - @var integer count
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getOrderItems(array $params = [])
    {
        return $this->request->post('market.getOrderItems', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer offset
     * - @var integer count
     * - @var boolean extended
     * - @var string date_from: Orders status updated date from (format: yyyy-mm-dd)
     * - @var string date_to: Orders status updated date to (format: yyyy-mm-dd)
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getOrders(array $params = [])
    {
        return $this->request->post('market.getOrders', $params);
    }


    /**
     * Removes an item from one or multiple collections.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var integer item_id: Item ID.
     * - @var array[integer] album_ids: Collections IDs to remove item from.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiMarketAlbumNotFoundException Album not found
     * @throws VKApiMarketItemNotFoundException Item not found
     * @throws VKApiMarketNotEnabledException Market not enabled
     */
    public function removeFromAlbum(array $params = [])
    {
        return $this->request->post('market.removeFromAlbum', $params);
    }


    /**
     * Reorders the collections list.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var integer album_id: Collection ID.
     * - @var integer before: ID of a collection to place current collection before it.
     * - @var integer after: ID of a collection to place current collection after it.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessMarketException Access denied
     * @throws VKApiMarketAlbumNotFoundException Album not found
     * @throws VKApiMarketNotEnabledException Market not enabled
     */
    public function reorderAlbums(array $params = [])
    {
        return $this->request->post('market.reorderAlbums', $params);
    }


    /**
     * Changes item place in a collection.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var integer album_id: ID of a collection to reorder items in. Set 0 to reorder full items list.
     * - @var integer item_id: Item ID.
     * - @var integer before: ID of an item to place current item before it.
     * - @var integer after: ID of an item to place current item after it.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessMarketException Access denied
     * @throws VKApiMarketAlbumNotFoundException Album not found
     * @throws VKApiMarketItemNotFoundException Item not found
     * @throws VKApiMarketNotEnabledException Market not enabled
     */
    public function reorderItems(array $params = [])
    {
        return $this->request->post('market.reorderItems', $params);
    }


    /**
     * Sends a complaint to the item.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var integer item_id: Item ID.
     * - @var MarketReason reason: Complaint reason. Possible values: *'0' - spam,, *'1' - child porn,, *'2' - extremism,, *'3' - violence,, *'4' - drugs propaganda,, *'5' - adult materials,, *'6' - insult.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function report(array $params = [])
    {
        return $this->request->post('market.report', $params);
    }


    /**
     * Sends a complaint to the item's comment.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var integer comment_id: Comment ID.
     * - @var MarketReason reason: Complaint reason. Possible values: *'0' - spam,, *'1' - child porn,, *'2' - extremism,, *'3' - violence,, *'4' - drugs propaganda,, *'5' - adult materials,, *'6' - insult.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function reportComment(array $params = [])
    {
        return $this->request->post('market.reportComment', $params);
    }


    /**
     * Restores recently deleted item
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an item owner community.
     * - @var integer item_id: Deleted item ID.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessMarketException Access denied
     * @throws VKApiMarketRestoreTooLateException Too late for restore
     * @throws VKApiMarketNotEnabledException Market not enabled
     */
    public function restore(array $params = [])
    {
        return $this->request->post('market.restore', $params);
    }


    /**
     * Restores a recently deleted comment
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: identifier of an item owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
     * - @var integer comment_id: deleted comment id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function restoreComment(array $params = [])
    {
        return $this->request->post('market.restoreComment', $params);
    }


    /**
     * Searches market items in a community's catalog
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of an items owner community.
     * - @var integer album_id
     * - @var string q: Search query, for example "pink slippers".
     * - @var integer price_from: Minimum item price value.
     * - @var integer price_to: Maximum item price value.
     * - @var MarketSort sort
     * - @var MarketRev rev: '0' - do not use reverse order, '1' - use reverse order
     * - @var integer offset: Offset needed to return a specific subset of results.
     * - @var integer count: Number of items to return.
     * - @var boolean extended: '1' - to return additional fields: 'likes, can_comment, car_repost, photos'. By default: '0'.
     * - @var array[integer] status
     * - @var boolean need_variants: Add variants to response if exist
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function search(array $params = [])
    {
        return $this->request->post('market.search', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var string q
     * - @var integer offset
     * - @var integer count
     * - @var integer category_id
     * - @var integer price_from
     * - @var integer price_to
     * - @var MarketSortBy sort_by
     * - @var MarketSortDirection sort_direction
     * - @var integer country
     * - @var integer city
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function searchItems(array $params = [])
    {
        return $this->request->post('market.searchItems', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var string q
     * - @var integer offset
     * - @var integer count
     * - @var integer category_id
     * - @var integer price_from
     * - @var integer price_to
     * - @var MarketSortBy sort_by
     * - @var MarketSortDirection sort_direction
     * - @var integer country
     * - @var integer city
     * - @var boolean only_my_groups
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function searchItemsBasic(array $params = [])
    {
        return $this->request->post('market.searchItemsBasic', $params);
    }
}

