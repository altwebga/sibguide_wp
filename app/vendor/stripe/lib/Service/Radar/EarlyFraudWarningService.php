<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Service\Radar;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
class EarlyFraudWarningService extends \Voxel\Vendor\CloudPayments\Service\AbstractService
{
    /**
     * Returns a list of early fraud warnings.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Collection<\Voxel\Vendor\CloudPayments\Radar\EarlyFraudWarning>
     */
    public function all($params = null, $opts = null)
    {
        return $this->requestCollection('get', '/v1/radar/early_fraud_warnings', $params, $opts);
    }

    /**
     * Retrieves the details of an early fraud warning that has previously been
     * created.
     *
     * Please refer to the <a href="#early_fraud_warning_object">early fraud
     * warning</a> object reference for more details.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Radar\EarlyFraudWarning
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/v1/radar/early_fraud_warnings/%s', $id), $params, $opts);
    }
}
