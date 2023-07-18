<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\AppWidgetsImageType;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\AppWidgetsType;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiBlockedException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiCompileException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiParamGroupIdException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiParamPhotoException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiWallAccessPostException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiWallAccessRepliesException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class AppWidgets implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * AppWidgets constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Returns a URL for uploading a photo to the community collection for community app widgets
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var AppWidgetsImageType image_type
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getAppImageUploadServer(array $params = [])
    {
        return $this->request->post('appWidgets.getAppImageUploadServer', $params);
    }


    /**
     * Returns an app collection of images for community app widgets
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer offset: Offset needed to return a specific subset of images.
     * - @var integer count: Maximum count of results.
     * - @var AppWidgetsImageType image_type
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getAppImages(array $params = [])
    {
        return $this->request->post('appWidgets.getAppImages', $params);
    }


    /**
     * Returns a URL for uploading a photo to the community collection for community app widgets
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var AppWidgetsImageType image_type
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getGroupImageUploadServer(array $params = [])
    {
        return $this->request->post('appWidgets.getGroupImageUploadServer', $params);
    }


    /**
     * Returns a community collection of images for community app widgets
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer offset: Offset needed to return a specific subset of images.
     * - @var integer count: Maximum count of results.
     * - @var AppWidgetsImageType image_type
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getGroupImages(array $params = [])
    {
        return $this->request->post('appWidgets.getGroupImages', $params);
    }


    /**
     * Returns an image for community app widgets by its ID
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[string] images: List of images IDs
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getImagesById(array $params = [])
    {
        return $this->request->post('appWidgets.getImagesById', $params);
    }


    /**
     * Allows to save image into app collection for community app widgets
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string hash: Parameter returned when photo is uploaded to server
     * - @var string image: Parameter returned when photo is uploaded to server
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiParamPhotoException Invalid photo
     */
    public function saveAppImage(array $params = [])
    {
        return $this->request->post('appWidgets.saveAppImage', $params);
    }


    /**
     * Allows to save image into community collection for community app widgets
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string hash: Parameter returned when photo is uploaded to server
     * - @var string image: Parameter returned when photo is uploaded to server
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiParamPhotoException Invalid photo
     */
    public function saveGroupImage(array $params = [])
    {
        return $this->request->post('appWidgets.saveGroupImage', $params);
    }


    /**
     * Allows to update community app widget
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string code
     * - @var AppWidgetsType type
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiCompileException Unable to compile code
     * @throws VKApiBlockedException Content blocked
     * @throws VKApiWallAccessPostException Access to wall's post denied
     * @throws VKApiWallAccessRepliesException Access to post comments denied
     * @throws VKApiParamGroupIdException Invalid group id
     */
    public function update(array $params = [])
    {
        return $this->request->post('appWidgets.update', $params);
    }
}

