<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Service\Treasury;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
class DebitReversalService extends \Voxel\Vendor\CloudPayments\Service\AbstractService
{
    /**
     * Returns a list of DebitReversals.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Collection<\Voxel\Vendor\CloudPayments\Treasury\DebitReversal>
     */
    public function all($params = null, $opts = null)
    {
        return $this->requestCollection('get', '/v1/treasury/debit_reversals', $params, $opts);
    }

    /**
     * Reverses a ReceivedDebit and creates a DebitReversal object.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Treasury\DebitReversal
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/v1/treasury/debit_reversals', $params, $opts);
    }

    /**
     * Retrieves a DebitReversal object.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Treasury\DebitReversal
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/v1/treasury/debit_reversals/%s', $id), $params, $opts);
    }
}
