<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class LeadForms implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * LeadForms constructor.
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
     * - @var integer group_id
     * - @var string name
     * - @var string title
     * - @var string description
     * - @var string questions
     * - @var string policy_link_url
     * - @var string photo
     * - @var string confirmation
     * - @var string site_link_url
     * - @var boolean active
     * - @var boolean once_per_user
     * - @var string pixel_code
     * - @var array[integer] notify_admins
     * - @var array[string] notify_emails
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function create(array $params = [])
    {
        return $this->request->post('leadForms.create', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer group_id
     * - @var integer form_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     */
    public function delete(array $params = [])
    {
        return $this->request->post('leadForms.delete', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer group_id
     * - @var integer form_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     */
    public function get(array $params = [])
    {
        return $this->request->post('leadForms.get', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer group_id
     * - @var integer form_id
     * - @var integer limit
     * - @var string next_page_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     */
    public function getLeads(array $params = [])
    {
        return $this->request->post('leadForms.getLeads', $params);
    }


    /**
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getUploadURL(string $access_token)
    {
        return $this->request->post('leadForms.getUploadURL', $access_token);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer group_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function list(array $params = [])
    {
        return $this->request->post('leadForms.list', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer group_id
     * - @var integer form_id
     * - @var string name
     * - @var string title
     * - @var string description
     * - @var string questions
     * - @var string policy_link_url
     * - @var string photo
     * - @var string confirmation
     * - @var string site_link_url
     * - @var boolean active
     * - @var boolean once_per_user
     * - @var string pixel_code
     * - @var array[integer] notify_admins
     * - @var array[string] notify_emails
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     */
    public function update(array $params = [])
    {
        return $this->request->post('leadForms.update', $params);
    }
}

