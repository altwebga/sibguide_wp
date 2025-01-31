<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Service\TestHelpers\Issuing;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
class CardService extends \Voxel\Vendor\CloudPayments\Service\AbstractService
{
    /**
     * Updates the shipping status of the specified Issuing <code>Card</code> object to
     * <code>delivered</code>.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Issuing\Card
     */
    public function deliverCard($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/test_helpers/issuing/cards/%s/shipping/deliver', $id), $params, $opts);
    }

    /**
     * Updates the shipping status of the specified Issuing <code>Card</code> object to
     * <code>failure</code>.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Issuing\Card
     */
    public function failCard($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/test_helpers/issuing/cards/%s/shipping/fail', $id), $params, $opts);
    }

    /**
     * Updates the shipping status of the specified Issuing <code>Card</code> object to
     * <code>returned</code>.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Issuing\Card
     */
    public function returnCard($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/test_helpers/issuing/cards/%s/shipping/return', $id), $params, $opts);
    }

    /**
     * Updates the shipping status of the specified Issuing <code>Card</code> object to
     * <code>shipped</code>.
     *
     * @param string $id
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Issuing\Card
     */
    public function shipCard($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/test_helpers/issuing/cards/%s/shipping/ship', $id), $params, $opts);
    }
}
