<?php
namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\Actions\Enums\LeadsStatus;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiActionFailedException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiLimitsException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiVotesException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

/**
 */
class Leads
{

    /**
     * @var Request
     */
    private $request;

    /**
     * Leads constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Checks if the user can start the lead.
     *
     * @param  string $access_token
     * @param  array  $params       
     *                              -
     * @var
     *                       integer
     *                       lead_id:
     *                       Lead
     *                       ID.
     *                       -
     * @var
     *                       integer
     *                       test_result:
     *                       Value
     *                       to
     *                       be
     *                       return
     *                       in
     *                       'result'
     *                       field
     *                       when
     *                       test
     *                       mode
     *                       is
     *                       used.
     *                       -
     * @var
     *                       boolean
     *                       test_mode
     *                       -
     * @var
     *                       boolean
     *                       auto_start
     *                       -
     * @var
     *                       integer
     *                       age:
     *                       User
     *                       age.
     *                       -
     * @var
     *                       string
     *                       country:
     *                       User
     *                       country
     *                       code.                              
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiActionFailedException Unable to process action
     * @return mixed
     */
    public function checkUser(array $params = [])
    {
        return $this->request->post('leads.checkUser', $params);
    }

    /**
     * Completes the lead started by user.
     *
     * @param  string $access_token
     * @param  array  $params       
     *                              -     
     * @var
     *                       string
     *                       vk_sid:
     *                       Session
     *                       obtained
     *                       as
     *                       GET
     *                       parameter
     *                       when
     *                       session
     *                       started.
     *                       -
     * @var
     *                       string
     *                       secret:
     *                       Secret
     *                       key
     *                       from
     *                       the
     *                       lead
     *                       testing
     *                       interface.
     *                       -
     * @var
     *                       string
     *                       comment:
     *                       Comment
     *                       text.               
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiLimitsException Out of limits
     * @throws VKApiVotesException Not enough votes
     * @return mixed
     */
    public function complete(array $params = [])
    {
        return $this->request->post('leads.complete', $params);
    }

    /**
     * Returns lead stats data.
     *
     * @param  string $access_token
     * @param  array  $params       
     *                              -     
     * @var
     *                       integer
     *                       lead_id:
     *                       Lead
     *                       ID.
     *                       -
     * @var
     *                       string
     *                       secret:
     *                       Secret
     *                       key
     *                       obtained
     *                       from
     *                       the
     *                       lead
     *                       testing
     *                       interface.
     *                       -
     * @var
     *                       string
     *                       date_start:
     *                       Day
     *                       to
     *                       start
     *                       stats
     *                       from
     *                       (YYYY_MM_DD,
     *                       e.g.2011-09-17).
     *                       -
     * @var
     *                       string
     *                       date_end:
     *                       Day
     *                       to
     *                       finish
     *                       stats
     *                       (YYYY_MM_DD,
     *                       e.g.2011-09-17).                    
     * @throws VKClientException
     * @throws VKApiException
     * @return mixed
     */
    public function getStats(array $params = [])
    {
        return $this->request->post('leads.getStats', $params);
    }

    /**
     * Returns a list of last user actions for the offer.
     *
     * @param  string $access_token
     * @param  array  $params       
     *                              -     
     * @var
     *                       integer
     *                       offer_id:
     *                       Offer
     *                       ID.
     *                       -
     * @var
     *                       string
     *                       secret:
     *                       Secret
     *                       key
     *                       obtained
     *                       in
     *                       the
     *                       lead
     *                       testing
     *                       interface.
     *                       -
     * @var
     *                       integer
     *                       offset:
     *                       Offset
     *                       needed
     *                       to
     *                       return
     *                       a
     *                       specific
     *                       subset
     *                       of
     *                       results.
     *                       -
     * @var
     *                       integer
     *                       count:
     *                       Number
     *                       of
     *                       results
     *                       to
     *                       return.
     *                       -
     * @var
     *                       LeadsStatus
     *                       status:
     *                       Action
     *                       type.
     *                       Possible
     *                       values:
     *                       *'0'
     *                       —
     *                       start,,
     *                       *'1'
     *                       —
     *                       finish,,
     *                       *'2'
     *                       —
     *                       blocking
     *                       users,,
     *                       *'3'
     *                       —
     *                       start
     *                       in
     *                       a
     *                       test
     *                       mode,,
     *                       *'4'
     *                       —
     *                       finish
     *                       in
     *                       a
     *                       test
     *                       mode.
     *                       -
     * @var
     *                       boolean
     *                       reverse:
     *                       Sort
     *                       order.
     *                       Possible
     *                       values:
     *                       *'1'
     *                       —
     *                       chronological,,
     *                       *'0'
     *                       —
     *                       reverse
     *                       chronological.                              
     * @throws VKClientException
     * @throws VKApiException
     * @return mixed
     */
    public function getUsers(array $params = [])
    {
        return $this->request->post('leads.getUsers', $params);
    }

    /**
     * Counts the metric event.
     *
     * @param  string $access_token
     * @param  array  $params       
     *                              -     
     * @var
     *                       string
     *                       data:
     *                       Metric
     *                       data
     *                       obtained
     *                       in
     *                       the
     *                       lead
     *                       interface.     
     * @throws VKClientException
     * @throws VKApiException
     * @return mixed
     */
    public function metricHit(array $params = [])
    {
        return $this->request->post('leads.metricHit', $params);
    }

    /**
     * Creates new session for the user passing the offer.
     *
     * @param  string $access_token
     * @param  array  $params       
     *                              -     
     * @var
     *                       integer
     *                       lead_id:
     *                       Lead
     *                       ID.
     *                       -
     * @var
     *                       string
     *                       secret:
     *                       Secret
     *                       key
     *                       from
     *                       the
     *                       lead
     *                       testing
     *                       interface.
     *                       -
     * @var
     *                       integer
     *                       uid
     *                       -
     * @var
     *                       integer
     *                       aid
     *                       -
     * @var
     *                       boolean
     *                       test_mode
     *                       -
     * @var
     *                       boolean
     *                       force                              
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiLimitsException Out of limits
     * @return mixed
     */
    public function start(array $params = [])
    {
        return $this->request->post('leads.start', $params);
    }
}
