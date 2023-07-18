<?php

namespace ctapu4ok\VkMessengerSdk\Ips;

use ctapu4ok\VkMessengerSdk\Exceptions\TransportRequestException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKLongPollServerKeyExpiredException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKLongPollServerTsException;

class LongPollCallback
{
    protected const PARAM_GROUP_ID = 'group_id';
    protected const PARAM_ACT = 'act';
    protected const PARAM_KEY = 'key';
    protected const PARAM_TS = 'ts';
    protected const PARAM_WAIT = 'wait';
    protected const VALUE_ACT = 'a_check';

    protected const EVENTS_FAILED = 'failed';
    protected const EVENTS_TS = 'ts';
    protected const EVENTS_UPDATES = 'updates';

    protected const EVENT_TYPE = 'type';
    protected const EVENT_OBJECT = 'object';

    protected const SERVER_TIMESTAMP = 'ts';
    protected const SERVER_URL = 'url';
    protected const SERVER_KEY = 'key';

    protected const ERROR_CODE_INCORRECT_TS_VALUE = 1;
    protected const ERROR_CODE_TOKEN_EXPIRED = 2;

    protected const CONNECTION_TIMEOUT = 10;
    protected const HTTP_STATUS_CODE_OK = 200;
    protected const DEFAULT_WAIT = 10;

    protected $api_client;
    protected $access_token;
    protected $group_id;
    protected $handler;
    protected $http_client;
    protected $server;
    protected $last_ts = null;
    protected $wait;

    public function __construct(
        Client $api_client,
        int    $wait = self::DEFAULT_WAIT
    ) {
        $this->api_client = $api_client;
        $this->handler = $this->api_client->getInstance();
        $this->http_client = new CurlHttpClient(static::CONNECTION_TIMEOUT);
        $this->wait = $wait;
        $this->group_id = $this->api_client->vk->getRequest()->getSettings()->getAppInfo()->getGroupId();
    }

    /**
     * @param int|null $ts
     * @return mixed|null
     */
    public function listen(?int $ts = null)
    {
        if ($this->server === null) {
            $this->server = $this->getLongPollServer();
        }

        if ($this->last_ts === null) {
            $this->last_ts = $this->server[static::SERVER_TIMESTAMP];
        }

        if ($ts === null) {
            $ts = $this->last_ts;
        }
        try {
            $response = $this->getEvents($this->server[static::SERVER_URL], $this->server[static::SERVER_KEY], $ts);

            foreach ($response[static::EVENTS_UPDATES] as $event) {
                $this->handler->parseObject(
                    $this->group_id,
                    null,
                    $event[static::EVENT_TYPE],
                    $event[static::EVENT_OBJECT]
                );
            }

            $this->last_ts = $response[static::EVENTS_TS];
        } catch (VKLongPollServerKeyExpiredException|VKClientException $e) {
            $this->server = $this->getLongPollServer();
        }
        return $this->last_ts;
    }

    /**
     * @return array
     */
    protected function getLongPollServer(): array
    {
        $server = $this->api_client->vk->groups()->getLongPollServer([
            static::PARAM_GROUP_ID => $this->api_client->vk->getRequest()->getSettings()->getAppInfo()->getGroupId()
        ]);

        return [
            static::SERVER_URL       => $server['server'],
            static::SERVER_TIMESTAMP => $server['ts'],
            static::SERVER_KEY       => $server['key'],
        ];
    }

    /**
     * @throws VKClientException
     */
    public function getEvents(string $host, string $key, int $ts)
    {
        $params = array(
            static::PARAM_KEY  => $key,
            static::PARAM_TS   => $ts,
            static::PARAM_WAIT => $this->wait,
            static::PARAM_ACT  => static::VALUE_ACT
        );

        try {
            $response = $this->http_client->get($host, $params);
        } catch (TransportRequestException $e) {
            throw new VKClientException($e);
        }


        return $this->parseResponse($params, $response);
    }

    /**
     * @throws VKClientException
     * @throws VKLongPollServerKeyExpiredException
     * @throws VKLongPollServerTsException
     */
    private function parseResponse(array $params, TransportClientResponse $response)
    {
        $this->checkHttpStatus($response);

        $body = $response->getBody();
        $decode_body = $this->decodeBody($body);

        if (isset($decode_body[static::EVENTS_FAILED])) {
            switch ($decode_body[static::EVENTS_FAILED]) {
                case static::ERROR_CODE_INCORRECT_TS_VALUE:
                    $ts = $params[static::PARAM_TS];
                    $msg = '\'ts\' value is incorrect, minimal value is 1, maximal value is ' . $ts;
                    throw new VKLongPollServerTsException($msg);

                case static::ERROR_CODE_TOKEN_EXPIRED:
                    throw new VKLongPollServerKeyExpiredException('Try to generate a new key.');

                default:
                    throw new VKClientException(
                        'Unknown LongPollServer exception, something went wrong. ' .
                        $decode_body
                    );
            }
        }

        return $decode_body;
    }

    /**
     * Decodes body.
     *
     * @param string $body
     * @return mixed
     */
    protected function decodeBody(string $body): mixed
    {
        $decoded_body = json_decode($body, true);

        if (!is_array($decoded_body)) {
            $decoded_body = [];
        }

        return $decoded_body;
    }

    /**
     * Check http status of response
     *
     * @param TransportClientResponse $response
     * @throws VKClientException
     */
    protected function checkHttpStatus(TransportClientResponse $response): void
    {
        if ($response->getHttpStatus() != static::HTTP_STATUS_CODE_OK) {
            throw new VKClientException('Invalid http status: ' . $response->getHttpStatus());
        }
    }
}
