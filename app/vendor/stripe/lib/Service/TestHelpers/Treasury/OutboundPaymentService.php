<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Service\TestHelpers\Treasury;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
class OutboundPaymentService extends \Voxel\Vendor\CloudPayments\Service\AbstractService
{
    /**
     * Transitions a test mode created OutboundPayment to the <code>failed</code>
     * status. The OutboundPayment must already be in the <code>processing</code>
     * state.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Treasury\OutboundPayment
     */
    public function fail($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/test_helpers/treasury/outbound_payments/%s/fail', $id), $params, $opts);
    }

    /**
     * Transitions a test mode created OutboundPayment to the <code>posted</code>
     * status. The OutboundPayment must already be in the <code>processing</code>
     * state.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Treasury\OutboundPayment
     */
    public function post($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/test_helpers/treasury/outbound_payments/%s/post', $id), $params, $opts);
    }

    /**
     * Transitions a test mode created OutboundPayment to the <code>returned</code>
     * status. The OutboundPayment must already be in the <code>processing</code>
     * state.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Treasury\OutboundPayment
     */
    public function returnOutboundPayment($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/test_helpers/treasury/outbound_payments/%s/return', $id), $params, $opts);
    }
}
