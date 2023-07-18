<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\NotesSort;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiAccessCommentException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiAccessNoteCommentException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiAccessNoteException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiParamNoteIdException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Notes implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Notes constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Creates a new note for the current user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string title: Note title.
     * - @var string text: Note text.
     * - @var array[string] privacy_view
     * - @var array[string] privacy_comment
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function add(array $params = [])
    {
        return $this->request->post('notes.add', $params);
    }


    /**
     * Adds a new comment on a note.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer note_id: Note ID.
     * - @var integer owner_id: Note owner ID.
     * - @var integer reply_to: ID of the user to whom the reply is addressed (if the comment is a reply to another comment).
     * - @var string message: Comment text.
     * - @var string guid
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessNoteException Access to note denied
     * @throws VKApiAccessNoteCommentException You can't comment this note
     */
    public function createComment(array $params = [])
    {
        return $this->request->post('notes.createComment', $params);
    }


    /**
     * Deletes a note of the current user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer note_id: Note ID.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiParamNoteIdException Note not found
     */
    public function delete(array $params = [])
    {
        return $this->request->post('notes.delete', $params);
    }


    /**
     * Deletes a comment on a note.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer comment_id: Comment ID.
     * - @var integer owner_id: Note owner ID.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessNoteException Access to note denied
     * @throws VKApiAccessCommentException Access to comment denied
     */
    public function deleteComment(array $params = [])
    {
        return $this->request->post('notes.deleteComment', $params);
    }


    /**
     * Edits a note of the current user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer note_id: Note ID.
     * - @var string title: Note title.
     * - @var string text: Note text.
     * - @var array[string] privacy_view
     * - @var array[string] privacy_comment
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiParamNoteIdException Note not found
     */
    public function edit(array $params = [])
    {
        return $this->request->post('notes.edit', $params);
    }


    /**
     * Edits a comment on a note.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer comment_id: Comment ID.
     * - @var integer owner_id: Note owner ID.
     * - @var string message: New comment text.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessCommentException Access to comment denied
     */
    public function editComment(array $params = [])
    {
        return $this->request->post('notes.editComment', $params);
    }


    /**
     * Returns a list of notes created by a user.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var array[integer] note_ids: Note IDs.
     * - @var integer user_id: Note owner ID.
     * - @var integer offset
     * - @var integer count: Number of notes to return.
     * - @var NotesSort sort
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiParamNoteIdException Note not found
     */
    public function get(array $params = [])
    {
        return $this->request->post('notes.get', $params);
    }


    /**
     * Returns a note by its ID.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer note_id: Note ID.
     * - @var integer owner_id: Note owner ID.
     * - @var boolean need_wiki
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessNoteException Access to note denied
     * @throws VKApiParamNoteIdException Note not found
     */
    public function getById(array $params = [])
    {
        return $this->request->post('notes.getById', $params);
    }


    /**
     * Returns a list of comments on a note.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer note_id: Note ID.
     * - @var integer owner_id: Note owner ID.
     * - @var NotesSort sort
     * - @var integer offset
     * - @var integer count: Number of comments to return.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessNoteException Access to note denied
     */
    public function getComments(array $params = [])
    {
        return $this->request->post('notes.getComments', $params);
    }


    /**
     * Restores a deleted comment on a note.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer comment_id: Comment ID.
     * - @var integer owner_id: Note owner ID.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessCommentException Access to comment denied
     */
    public function restoreComment(array $params = [])
    {
        return $this->request->post('notes.restoreComment', $params);
    }
}

