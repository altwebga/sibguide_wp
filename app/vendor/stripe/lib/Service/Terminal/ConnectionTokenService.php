<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Service\Terminal;

/**
 * @phpstan-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
/**
 * @psalm-import-type RequestOptionsArray from \Voxel\Vendor\CloudPayments\Util\RequestOptions
 */
class ConnectionTokenService extends \Voxel\Vendor\CloudPayments\Service\AbstractService
{
    /**
     * To connect to a reader the CloudPayments Terminal SDK needs to retrieve a short-lived
     * connection token from CloudPayments, proxied through your server. On your backend, add
     * an endpoint that creates and returns a connection token.
     *
     * @param null|array $params
     * @param null|RequestOptionsArray|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Terminal\ConnectionToken
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/v1/terminal/connection_tokens', $params, $opts);
    }
}
