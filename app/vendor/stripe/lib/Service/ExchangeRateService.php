<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\Stripe\Service;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\Stripe\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\Stripe\Util\RequestOptions
 */
class ExchangeRateService extends \Voxel\Vendor\Stripe\Service\AbstractService
{
    /**
     * Returns a list of objects that contain the rates at which foreign currencies are
     * converted to one another. Only shows the currencies for which Stripe supports.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\Stripe\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\Stripe\Collection<\Voxel\Vendor\Stripe\ExchangeRate>
     */
    public function all($params = null, $opts = null)
    {
        return $this->requestCollection('get', '/v1/exchange_rates', $params, $opts);
    }

    /**
     * Retrieves the exchange rates from the given currency to every supported
     * currency.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\Stripe\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\Stripe\ExchangeRate
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/v1/exchange_rates/%s', $id), $params, $opts);
    }
}
