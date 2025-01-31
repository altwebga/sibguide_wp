<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Service;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
class PaymentMethodConfigurationService extends \Voxel\Vendor\CloudPayments\Service\AbstractService
{
    /**
     * List payment method configurations.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Collection<\Voxel\Vendor\CloudPayments\PaymentMethodConfiguration>
     */
    public function all($params = null, $opts = null)
    {
        return $this->requestCollection('get', '/v1/payment_method_configurations', $params, $opts);
    }

    /**
     * Creates a payment method configuration.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\PaymentMethodConfiguration
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/v1/payment_method_configurations', $params, $opts);
    }

    /**
     * Retrieve payment method configuration.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\PaymentMethodConfiguration
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/v1/payment_method_configurations/%s', $id), $params, $opts);
    }

    /**
     * Update payment method configuration.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\PaymentMethodConfiguration
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/payment_method_configurations/%s', $id), $params, $opts);
    }
}
