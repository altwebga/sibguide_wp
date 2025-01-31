<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Service\Climate;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
class SupplierService extends \Voxel\Vendor\CloudPayments\Service\AbstractService
{
    /**
     * Lists all available Climate supplier objects.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Collection<\Voxel\Vendor\CloudPayments\Climate\Supplier>
     */
    public function all($params = null, $opts = null)
    {
        return $this->requestCollection('get', '/v1/climate/suppliers', $params, $opts);
    }

    /**
     * Retrieves a Climate supplier object.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Climate\Supplier
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/v1/climate/suppliers/%s', $id), $params, $opts);
    }
}
