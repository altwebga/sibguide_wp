<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\Stripe\Service\TestHelpers\Treasury;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\Stripe\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\Stripe\Util\RequestOptions
 */
class ReceivedCreditService extends \Voxel\Vendor\Stripe\Service\AbstractService
{
    /**
     * Use this endpoint to simulate a test mode ReceivedCredit initiated by a third
     * party. In live mode, you can’t directly create ReceivedCredits initiated by
     * third parties.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\Stripe\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\Stripe\Treasury\ReceivedCredit
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/v1/test_helpers/treasury/received_credits', $params, $opts);
    }
}
