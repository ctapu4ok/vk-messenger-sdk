<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiStickersNotFavoriteException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiStickersNotPurchasedException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiStickersTooManyFavoritesException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Store implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Store constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Adds given sticker IDs to the list of user's favorite stickers
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] sticker_ids: Sticker IDs to be added
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiStickersNotPurchasedException Stickers are not purchased
     * @throws VKApiStickersTooManyFavoritesException Too many favorite stickers
     */
    public function addStickersToFavorite(array $params = [])
    {
        return $this->request->post('store.addStickersToFavorite', $params);
    }


    /**
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getFavoriteStickers(string $access_token)
    {
        return $this->request->post('store.getFavoriteStickers', $access_token);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var string type
     * - @var string merchant
     * - @var string section
     * - @var array[integer] product_ids
     * - @var array[string] filters
     * - @var boolean extended
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getProducts(array $params = [])
    {
        return $this->request->post('store.getProducts', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] stickers_ids
     * - @var array[integer] products_ids
     * - @var boolean aliases
     * - @var boolean all_products
     * - @var boolean need_stickers
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getStickersKeywords(array $params = [])
    {
        return $this->request->post('store.getStickersKeywords', $params);
    }


    /**
     * Removes given sticker IDs from the list of user's favorite stickers
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] sticker_ids: Sticker IDs to be removed
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiStickersNotFavoriteException Stickers are not favorite
     */
    public function removeStickersFromFavorite(array $params = [])
    {
        return $this->request->post('store.removeStickersFromFavorite', $params);
    }
}

