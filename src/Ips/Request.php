<?php

namespace ctapu4ok\VkMessengerSdk\Ips;

use ctapu4ok\VkMessengerSdk\API\VKApiError;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\ExceptionMapper;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;
use ctapu4ok\VkMessengerSdk\Settings;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class Request
{
    protected const PARAM_VERSION = 'v';
    protected const PARAM_ACCESS_TOKEN = 'access_token';
    protected const PARAM_LANG = 'lang';

    protected const KEY_ERROR = 'error';
    protected const KEY_RESPONSE = 'response';

    protected const CONNECTION_TIMEOUT = 10;
    protected const HTTP_STATUS_CODE_OK = 200;
    protected string $version;
    protected string $endpoint;
    protected string $language;
    protected Settings $settings;

    protected ClientInterface $client;
    public function __construct(
        string $apiVersion,
        string $apiEndpoint,
        string $lang,
        Settings $settings,
        ?ClientInterface $client = null
    ) {
        $this->version = $apiVersion;
        $this->endpoint = $apiEndpoint;
        $this->language = $lang;
        $this->client = $client ?: new HClient(
            [
            'base_uri' => $this->endpoint,
            'timeout'  => static::CONNECTION_TIMEOUT,
            ]
        );
        $this->settings = $settings;
    }

    /**
     * Makes post request.
     *
     * @param string $method
     * @param array  $params
     *
     * @return mixed
     *
     * @throws VKClientException
     * @throws VKApiException
     */
    public function post(string $method, array $params = array()): mixed
    {
        $params = $this->formatParams($params);
        $params[static::PARAM_ACCESS_TOKEN] = $this->settings->getAppInfo()->getApiHash();

        if (!isset($params[static::PARAM_VERSION])) {
            $params[static::PARAM_VERSION] = $this->version;
        }

        if ($this->language && !isset($params[static::PARAM_LANG])) {
            $params[static::PARAM_LANG] = $this->language;
        }

        try {
            $response = $this->client->post("{$this->endpoint}/{$method}?" . http_build_query($params));
        } catch (GuzzleException $exception) {
            throw new VKClientException($exception);
        }

        return $this->parseResponse($response);
    }

    /**
     * Uploads data by its path to the given url.
     *
     * @param string $upload_url
     * @param string $parameter_name
     * @param string $path
     *
     * @return mixed
     *
     * @throws VKClientException
     * @throws VKApiException
     */
    public function upload(string $upload_url, string $parameter_name, string $path): mixed
    {
        try {
            $response = $this->client->post(
                $upload_url,
                [
                'multipart' => [
                    [
                        'name' => $parameter_name,
                        'contents' => Utils::tryFopen($path, 'rb'),
                    ],
                ],
                ]
            );
        } catch (GuzzleException $exception) {
            throw new VKClientException($exception);
        }

        return $this->parseResponse($response);
    }

    /**
     * Decodes the response and checks its status code and whether it has an Api error. Returns decoded response.
     *
     * @param ResponseInterface $response
     *
     * @return mixed
     *
     * @throws VKApiException
     * @throws VKClientException
     */
    private function parseResponse(ResponseInterface $response): mixed
    {
        if ($response->getStatusCode() !== static::HTTP_STATUS_CODE_OK) {
            throw new VKClientException("Invalid http status: {$response->getStatusCode()}");
        }

        $body = $response->getBody()->getContents();
        $decode_body = $this->decodeBody($body);

        if (isset($decode_body[static::KEY_ERROR])) {
            $error = $decode_body[static::KEY_ERROR];
            $api_error = new VKApiError($error);
            throw ExceptionMapper::parse($api_error);
        }

        if (isset($decode_body[static::KEY_RESPONSE])) {
            return $decode_body[static::KEY_RESPONSE];
        }

        return $decode_body;
    }

    /**
     * Formats given array of parameters for making the request.
     *
     * @param array<array-key, mixed> $params
     *
     * @return array<array-key, mixed>
     */
    private function formatParams(array $params): array
    {
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $params[$key] = implode(',', $value);
            } elseif (is_bool($value)) {
                $params[$key] = $value ? 1 : 0;
            }
        }
        return $params;
    }

    /**
     * Decodes body.
     *
     * @param string $body
     *
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
     * @return Settings
     */
    public function getSettings(): Settings
    {
        return $this->settings;
    }

    /**
     * @param Settings $settings
     */
    public function setSettings(Settings $settings): void
    {
        $this->settings = $settings;
    }
}
