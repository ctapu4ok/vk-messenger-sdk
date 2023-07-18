<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\AsrModel;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiAsrAudioDurationFloodedException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiAsrFileIsTooBigException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiAsrInvalidHashException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiAsrNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Asr implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Asr constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Returns status of the task with provided `task_id`
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string task_id: ID of ASR task in UUID format.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAsrNotFoundException Task not found
     */
    public function checkStatus(array $params = [])
    {
        return $this->request->post('asr.checkStatus', $params);
    }


    /**
     * Returns the server address to [vk.com/dev/upload_files_2|upload audio files].
     *
     * @param  string $access_token
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getUploadUrl(string $access_token)
    {
        return $this->request->post('asr.getUploadUrl', $access_token);
    }


    /**
     * Starts ASR task on [vk.com/dev/upload_files_2|uploaded audio file].
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var string audio: This parameter is a JSON response returned from [vk.com/dev/upload_files_2|file uploading server].
     * - @var AsrModel model: Which model to use for recognition. `neutral` -- general purpose (interviews, TV shows, etc.), `spontaneous` -- for NSFW audios (slang, profanity, etc.)
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAsrFileIsTooBigException Audio file is too big
     * @throws VKApiAsrAudioDurationFloodedException Total audio duration limit reached
     * @throws VKApiAsrInvalidHashException Invalid hash
     */
    public function process(array $params = [])
    {
        return $this->request->post('asr.process', $params);
    }
}

