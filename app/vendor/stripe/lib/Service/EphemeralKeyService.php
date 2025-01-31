<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Service;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
class EphemeralKeyService extends \Voxel\Vendor\CloudPayments\Service\AbstractService
{
    /**
     * Invalidates a short-lived API key for a given resource.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\EphemeralKey
     */
    public function delete($id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/v1/ephemeral_keys/%s', $id), $params, $opts);
    }

    /**
     * Creates a short-lived API key for a given resource.
     *
     * @param null|array $params
     * @param null|array|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\EphemeralKey
     */
    public function create($params = null, $opts = null)
    {
        if (!$opts || !isset($opts['cloudpayments_version'])) {
            throw new \Voxel\Vendor\CloudPayments\Exception\InvalidArgumentException('cloudpayments_version must be specified to create an ephemeral key');
        }

        return $this->request('post', '/v1/ephemeral_keys', $params, $opts);
    }
}
