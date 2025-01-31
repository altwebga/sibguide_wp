<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\Stripe\Service\Tax;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\Stripe\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\Stripe\Util\RequestOptions
 */
class TransactionService extends \Voxel\Vendor\Stripe\Service\AbstractService
{
    /**
     * Retrieves the line items of a committed standalone transaction as a collection.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\Stripe\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\Stripe\Collection<\Voxel\Vendor\Stripe\Tax\TransactionLineItem>
     */
    public function allLineItems($id, $params = null, $opts = null)
    {
        return $this->requestCollection('get', $this->buildPath('/v1/tax/transactions/%s/line_items', $id), $params, $opts);
    }

    /**
     * Creates a Tax <code>Transaction</code> from a calculation.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\Stripe\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\Stripe\Tax\Transaction
     */
    public function createFromCalculation($params = null, $opts = null)
    {
        return $this->request('post', '/v1/tax/transactions/create_from_calculation', $params, $opts);
    }

    /**
     * Partially or fully reverses a previously created <code>Transaction</code>.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\Stripe\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\Stripe\Tax\Transaction
     */
    public function createReversal($params = null, $opts = null)
    {
        return $this->request('post', '/v1/tax/transactions/create_reversal', $params, $opts);
    }

    /**
     * Retrieves a Tax <code>Transaction</code> object.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\Stripe\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\Stripe\Tax\Transaction
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/v1/tax/transactions/%s', $id), $params, $opts);
    }
}
