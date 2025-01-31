<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Service;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
class SetupAttemptService extends \Voxel\Vendor\CloudPayments\Service\AbstractService
{
    /**
     * Returns a list of SetupAttempts that associate with a provided SetupIntent.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Collection<\Voxel\Vendor\CloudPayments\SetupAttempt>
     */
    public function all($params = null, $opts = null)
    {
        return $this->requestCollection('get', '/v1/setup_attempts', $params, $opts);
    }
}
