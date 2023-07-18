<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\BugtrackerFilterRole;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\BugtrackerRole;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiActionFailedException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiLimitsException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiParamPhotosException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Bugtracker implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Bugtracker constructor.
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
     * - @var integer company_id
     * - @var array[integer] user_ids
     * - @var array[integer] company_group_ids
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @throws VKApiLimitsException Out of limits
     */
    public function addCompanyGroupsMembers(array $params = [])
    {
        return $this->request->post('bugtracker.addCompanyGroupsMembers', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] user_ids
     * - @var integer company_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @throws VKApiLimitsException Out of limits
     */
    public function addCompanyMembers(array $params = [])
    {
        return $this->request->post('bugtracker.addCompanyMembers', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer bugreport_id
     * - @var integer status
     * - @var string comment
     * - @var array[integer] from_statuses
     * - @var array[integer] not_in_statuses
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @throws VKApiActionFailedException Unable to process action
     */
    public function changeBugreportStatus(array $params = [])
    {
        return $this->request->post('bugtracker.changeBugreportStatus', $params);
    }


    /**
     * Creates the comment to bugreport
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer bugreport_id
     * - @var string text
     * - @var boolean hidden
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @throws VKApiParamPhotosException Invalid photos
     */
    public function createComment(array $params = [])
    {
        return $this->request->post('bugtracker.createComment', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer company_id
     * - @var integer company_group_id
     * - @var integer count
     * - @var integer offset
     * - @var string filter_name
     * - @var boolean extended
     * - @var array[BugtrackerFields] fields
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @throws VKApiLimitsException Out of limits
     */
    public function getCompanyGroupMembers(array $params = [])
    {
        return $this->request->post('bugtracker.getCompanyGroupMembers', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer company_id
     * - @var integer count
     * - @var integer offset
     * - @var string filter_name
     * - @var BugtrackerFilterRole filter_role
     * - @var integer filter_not_group
     * - @var boolean extended
     * - @var array[BugtrackerFields] fields
     * - @var boolean extra
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @throws VKApiLimitsException Out of limits
     */
    public function getCompanyMembers(array $params = [])
    {
        return $this->request->post('bugtracker.getCompanyMembers', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer product_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     */
    public function getProductBuildUploadServer(array $params = [])
    {
        return $this->request->post('bugtracker.getProductBuildUploadServer', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer company_id
     * - @var integer user_id
     * - @var integer company_group_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @throws VKApiLimitsException Out of limits
     */
    public function removeCompanyGroupMember(array $params = [])
    {
        return $this->request->post('bugtracker.removeCompanyGroupMember', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * - @var integer company_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiLimitsException Out of limits
     */
    public function removeCompanyMember(array $params = [])
    {
        return $this->request->post('bugtracker.removeCompanyMember', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer product_id
     * - @var integer version_id
     * - @var string title
     * - @var string release_notes
     * - @var boolean visible
     * - @var boolean set_rft
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     */
    public function saveProductVersion(array $params = [])
    {
        return $this->request->post('bugtracker.saveProductVersion', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * - @var integer company_id
     * - @var BugtrackerRole role
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @throws VKApiLimitsException Out of limits
     */
    public function setCompanyMemberRole(array $params = [])
    {
        return $this->request->post('bugtracker.setCompanyMemberRole', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer product_id
     * - @var boolean is_over
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @throws VKApiActionFailedException Unable to process action
     */
    public function setProductIsOver(array $params = [])
    {
        return $this->request->post('bugtracker.setProductIsOver', $params);
    }
}

