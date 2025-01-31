<?php

namespace Voxel\Vendor\CloudPayments;

/**
 * Interface for a CloudPayments client.
 */
interface CloudPaymentsClientInterface extends BaseCloudPaymentsClientInterface
{
    /**
     * Sends a request to CloudPayments's API.
     *
     * @param 'delete'|'get'|'post' $method the HTTP method
     * @param string $path the path of the request
     * @param array $params the parameters of the request
     * @param array|\Voxel\Vendor\CloudPayments\Util\RequestOptions $opts the special modifiers of the request
     *
     * @return \Voxel\Vendor\CloudPayments\CloudPaymentsObject the object returned by CloudPayments's API
     */
    public function request($method, $path, $params, $opts);
}
