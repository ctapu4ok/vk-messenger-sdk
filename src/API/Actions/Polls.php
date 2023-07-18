<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Base\NameCase;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\PollsBackgroundId;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\PollsNameCase;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiParamPhotoException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiPollsAccessException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiPollsAccessWithoutVoteException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiPollsAnswerIdException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiPollsPollIdException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Polls implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Polls constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Adds the current user's vote to the selected answer in the poll.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of the user or community that owns the poll. Use a negative value to designate a community ID.
     * - @var integer poll_id: Poll ID.
     * - @var array[integer] answer_ids
     * - @var boolean is_board
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiPollsAccessException Access to poll denied
     * @throws VKApiPollsAnswerIdException Invalid answer id
     * @throws VKApiPollsPollIdException Invalid poll id
     */
    public function addVote(array $params = [])
    {
        return $this->request->post('polls.addVote', $params);
    }


    /**
     * Creates polls that can be attached to the users' or communities' posts.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string question: question text
     * - @var boolean is_anonymous: '1' - anonymous poll, participants list is hidden,, '0' - public poll, participants list is available,, Default value is '0'.
     * - @var boolean is_multiple
     * - @var integer end_date
     * - @var integer owner_id: If a poll will be added to a communty it is required to send a negative group identifier. Current user by default.
     * - @var integer app_id
     * - @var string add_answers: available answers list, for example: " ["yes","no","maybe"]", There can be from 1 to 10 answers.
     * - @var integer photo_id
     * - @var PollsBackgroundId background_id
     * - @var boolean disable_unvote
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function create(array $params = [])
    {
        return $this->request->post('polls.create', $params);
    }


    /**
     * Deletes the current user's vote from the selected answer in the poll.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of the user or community that owns the poll. Use a negative value to designate a community ID.
     * - @var integer poll_id: Poll ID.
     * - @var boolean is_board
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiPollsAccessException Access to poll denied
     * @throws VKApiPollsAnswerIdException Invalid answer id
     * @throws VKApiPollsPollIdException Invalid poll id
     */
    public function deleteVote(array $params = [])
    {
        return $this->request->post('polls.deleteVote', $params);
    }


    /**
     * Edits created polls
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: poll owner id
     * - @var integer poll_id: edited poll's id
     * - @var string question: new question text
     * - @var string add_answers: answers list, for example: , "["yes","no","maybe"]"
     * - @var string edit_answers: object containing answers that need to be edited,, key - answer id, value - new answer text. Example: {"382967099":"option1", "382967103":"option2"}"
     * - @var string delete_answers: list of answer ids to be deleted. For example: "[382967099, 382967103]"
     * - @var integer end_date
     * - @var integer photo_id
     * - @var PollsBackgroundId background_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function edit(array $params = [])
    {
        return $this->request->post('polls.edit', $params);
    }


    /**
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getBackgrounds(string $access_token)
    {
        return $this->request->post('polls.getBackgrounds', $access_token);
    }


    /**
     * Returns detailed information about a poll by its ID.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of the user or community that owns the poll. Use a negative value to designate a community ID.
     * - @var boolean is_board: '1' - poll is in a board, '0' - poll is on a wall. '0' by default.
     * - @var integer poll_id: Poll ID.
     * - @var boolean extended
     * - @var integer friends_count
     * - @var array[string] fields
     * - @var PollsNameCase name_case
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiPollsAccessException Access to poll denied
     */
    public function getById(array $params = [])
    {
        return $this->request->post('polls.getById', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getPhotoUploadServer(array $params = [])
    {
        return $this->request->post('polls.getPhotoUploadServer', $params);
    }


    /**
     * Returns a list of IDs of users who selected specific answers in the poll.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer owner_id: ID of the user or community that owns the poll. Use a negative value to designate a community ID.
     * - @var integer poll_id: Poll ID.
     * - @var array[integer] answer_ids: Answer IDs.
     * - @var boolean is_board
     * - @var boolean friends_only: '1' - to return only current user's friends, '0' - to return all users (default),
     * - @var integer offset: Offset needed to return a specific subset of voters. '0' - (default)
     * - @var integer count: Number of user IDs to return (if the 'friends_only' parameter is not set, maximum '1000', otherwise '10'). '100' - (default)
     * - @var array[PollsFields] fields: Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate (birthdate)', 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online', 'counters'.
     * - @var NameCase name_case: Case for declension of user name and surname: , 'nom' - nominative (default) , 'gen' - genitive , 'dat' - dative , 'acc' - accusative , 'ins' - instrumental , 'abl' - prepositional
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiPollsAccessException Access to poll denied
     * @throws VKApiPollsAnswerIdException Invalid answer id
     * @throws VKApiPollsPollIdException Invalid poll id
     * @throws VKApiPollsAccessWithoutVoteException Access denied, please vote first
     */
    public function getVoters(array $params = [])
    {
        return $this->request->post('polls.getVoters', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var string photo
     * - @var string hash
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiParamPhotoException Invalid photo
     */
    public function savePhoto(array $params = [])
    {
        return $this->request->post('polls.savePhoto', $params);
    }
}

