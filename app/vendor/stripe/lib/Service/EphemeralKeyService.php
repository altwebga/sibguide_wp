<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\Stripe\Service;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\Stripe\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\Stripe\Util\RequestOptions
 */
class EphemeralKeyService extends \Voxel\Vendor\Stripe\Service\AbstractService
{
    /**
     * Invalidates a short-lived API key for a given resource.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\Stripe\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\Stripe\EphemeralKey
     */
    public function delete($id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/v1/ephemeral_keys/%s', $id), $params, $opts);
    }

    /**
     * Creates a short-lived API key for a given resource.
     *
     * @param null|array $params
     * @param null|array|\Voxel\Vendor\Stripe\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\Stripe\EphemeralKey
     */
    public function create($params = null, $opts = null)
    {
        if (!$opts || !isset($opts['stripe_version'])) {
            throw new \Voxel\Vendor\Stripe\Exception\InvalidArgumentException('stripe_version must be specified to create an ephemeral key');
        }

        return $this->request('post', '/v1/ephemeral_keys', $params, $opts);
    }
}
