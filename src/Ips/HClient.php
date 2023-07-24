<?php

namespace ctapu4ok\VkMessengerSdk\Ips;

use ctapu4ok\VkMessengerSdk\APIWrapper;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Utils;
use Psr\Http\Message\RequestInterface;

class HClient
{
    private HttpClient $client;
    private const USER_AGENT = 'ctapu4ok/vk-messenger-sdk lib/'.APIWrapper::RELEASE.' api/5.67';
    public function __construct(array $config = [])
    {

        $stack = new HandlerStack();
        $stack->setHandler(Utils::chooseHandler());

        $stack->push(
            Middleware::mapRequest(
                function (RequestInterface $r) {
                    return $r->withHeader('User-Agent', self::USER_AGENT . ' php/' . phpversion());
                }
            )
        );

        parent::__construct(
            array_merge(
                $config,
                ['handler' => $stack]
            )
        );
    }
}