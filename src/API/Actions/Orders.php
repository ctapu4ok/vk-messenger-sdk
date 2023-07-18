<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\OrdersAction;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiActionFailedException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiAppsSubscriptionInvalidStatusException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiAppsSubscriptionNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiLimitsException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;

class Orders implements ActionInterface
{
    /**
     * @param Request $request 
     */
    private Request $request;


    /**
     * Orders constructor.
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
     * - @var integer user_id
     * - @var integer subscription_id
     * - @var boolean pending_cancel
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAppsSubscriptionNotFoundException Subscription not found
     * @throws VKApiAppsSubscriptionInvalidStatusException Subscription is in invalid status
     */
    public function cancelSubscription(array $params = [])
    {
        return $this->request->post('orders.cancelSubscription', $params);
    }


    /**
     * Changes order status.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer order_id: order ID.
     * - @var OrdersAction action: action to be done with the order. Available actions: *cancel - to cancel unconfirmed order. *charge - to confirm unconfirmed order. Applies only if processing of [vk.com/dev/payments_status|order_change_state] notification failed. *refund - to cancel confirmed order.
     * - @var integer app_order_id: internal ID of the order in the application.
     * - @var boolean test_mode: if this parameter is set to 1, this method returns a list of test mode orders. By default - 0.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiLimitsException Out of limits
     * @throws VKApiActionFailedException Unable to process action
     */
    public function changeState(array $params = [])
    {
        return $this->request->post('orders.changeState', $params);
    }


    /**
     * Returns a list of orders.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer offset
     * - @var integer count: number of returned orders.
     * - @var boolean test_mode: if this parameter is set to 1, this method returns a list of test mode orders. By default - 0.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function get(array $params = [])
    {
        return $this->request->post('orders.get', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * - @var array[string] votes
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getAmount(array $params = [])
    {
        return $this->request->post('orders.getAmount', $params);
    }


    /**
     * Returns information about orders by their IDs.
     *
     * @param  string $access_token
     * @param  array  $params
     * - @var integer order_id: order ID.
     * - @var array[integer] order_ids: order IDs (when information about several orders is requested).
     * - @var boolean test_mode: if this parameter is set to 1, this method returns a list of test mode orders. By default - 0.
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getById(array $params = [])
    {
        return $this->request->post('orders.getById', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * - @var integer subscription_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAppsSubscriptionNotFoundException Subscription not found
     */
    public function getUserSubscriptionById(array $params = [])
    {
        return $this->request->post('orders.getUserSubscriptionById', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getUserSubscriptions(array $params = [])
    {
        return $this->request->post('orders.getUserSubscriptions', $params);
    }


    /**
     * @param  string $access_token
     * @param  array  $params
     * - @var integer user_id
     * - @var integer subscription_id
     * - @var integer price
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAppsSubscriptionNotFoundException Subscription not found
     * @throws VKApiAppsSubscriptionInvalidStatusException Subscription is in invalid status
     */
    public function updateSubscription(array $params = [])
    {
        return $this->request->post('orders.updateSubscription', $params);
    }
}

