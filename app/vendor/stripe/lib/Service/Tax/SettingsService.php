<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Service\Tax;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
class SettingsService extends \Voxel\Vendor\CloudPayments\Service\AbstractService
{
    /**
     * Retrieves Tax <code>Settings</code> for a merchant.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Tax\Settings
     */
    public function retrieve($params = null, $opts = null)
    {
        return $this->request('get', '/v1/tax/settings', $params, $opts);
    }

    /**
     * Updates Tax <code>Settings</code> parameters used in tax calculations. All
     * parameters are editable but none can be removed once set.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Tax\Settings
     */
    public function update($params = null, $opts = null)
    {
        return $this->request('post', '/v1/tax/settings', $params, $opts);
    }
}
