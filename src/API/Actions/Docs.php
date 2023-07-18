<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\DocsType;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMessagesDenySendException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiParamDocAccessException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiParamDocDeleteAccessException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiParamDocIdException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiParamDocTitleException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiSaveFileException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Docs implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Docs constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Copies a document to a user's or community's document list.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of the user or community that owns the document. Use a negative value to designate a community ID.
     * - @var integer doc_id: Document ID.
     * - @var string access_key: Access key. This parameter is required if 'access_key' was returned with the document's data.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function add(array $params = [])
    {
        return $this->request->post('docs.add', $params);
    }


    /**
     * Deletes a user or community document.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of the user or community that owns the document. Use a negative value to designate a community ID.
     * - @var integer doc_id: Document ID.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiParamDocDeleteAccessException Access to document deleting is denied
     * @throws VKApiParamDocIdException Invalid document id
     */
    public function delete(array $params = [])
    {
        return $this->request->post('docs.delete', $params);
    }


    /**
     * Edits a document.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: User ID or community ID. Use a negative value to designate a community ID.
     * - @var integer doc_id: Document ID.
     * - @var string title: Document title.
     * - @var array[string] tags: Document tags.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiParamDocAccessException Access to document is denied
     * @throws VKApiParamDocIdException Invalid document id
     * @throws VKApiParamDocTitleException Invalid document title
     */
    public function edit(array $params = [])
    {
        return $this->request->post('docs.edit', $params);
    }


    /**
     * Returns detailed information about user or community documents.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer count: Number of documents to return. By default, all documents.
     * - @var integer offset: Offset needed to return a specific subset of documents.
     * - @var DocsType type
     * - @var integer owner_id: ID of the user or community that owns the documents. Use a negative value to designate a community ID.
     * - @var boolean return_tags
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('docs.get', $params);
    }


    /**
     * Returns information about documents by their IDs.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[string] docs: Document IDs. Example: , "66748_91488,66748_91455",
     * - @var boolean return_tags
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getById(array $params = [])
    {
        return $this->request->post('docs.getById', $params);
    }


    /**
     * Returns the server address for document upload.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var DocsType type: Document type.
     * - @var integer peer_id: Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'Chat ID', e.g. '2000000001'. For community: '- Community ID', e.g. '-12345'. "
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiMessagesDenySendException Can't send messages for users without permission
     */
    public function getMessagesUploadServer(array $params = [])
    {
        return $this->request->post('docs.getMessagesUploadServer', $params);
    }


    /**
     * Returns documents types available for current user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of the user or community that owns the documents. Use a negative value to designate a community ID.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getTypes(array $params = [])
    {
        return $this->request->post('docs.getTypes', $params);
    }


    /**
     * Returns the server address for document upload.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer group_id: Community ID (if the document will be uploaded to the community).
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getUploadServer(array $params = [])
    {
        return $this->request->post('docs.getUploadServer', $params);
    }


    /**
     * Returns the server address for document upload onto a user's or community's wall.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer group_id: Community ID (if the document will be uploaded to the community).
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getWallUploadServer(array $params = [])
    {
        return $this->request->post('docs.getWallUploadServer', $params);
    }


    /**
     * Saves a document after [vk.com/dev/upload_files_2|uploading it to a server].
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string file: This parameter is returned when the file is [vk.com/dev/upload_files_2|uploaded to the server].
     * - @var string title: Document title.
     * - @var string tags: Document tags.
     * - @var boolean return_tags
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiSaveFileException Couldn't save file
     */
    public function save(array $params = [])
    {
        return $this->request->post('docs.save', $params);
    }


    /**
     * Returns a list of documents matching the search criteria.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string q: Search query string.
     * - @var boolean search_own
     * - @var integer count: Number of results to return.
     * - @var integer offset: Offset needed to return a specific subset of results.
     * - @var boolean return_tags
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function search(array $params = [])
    {
        return $this->request->post('docs.search', $params);
    }
}

