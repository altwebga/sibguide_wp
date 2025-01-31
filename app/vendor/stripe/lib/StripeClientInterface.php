<?php

namespace Voxel\Vendor\Stripe;

/**
 * Interface for a Stripe client.
 */
interface StripeClientInterface extends BaseStripeClientInterface
{
    /**
     * Sends a request to Stripe's API.
     *
     * @param 'delete'|'get'|'post' $method the HTTP method
     * @param string $path the path of the request
     * @param array $params the parameters of the request
     * @param array|\Voxel\Vendor\Stripe\Util\RequestOptions $opts the special modifiers of the request
     *
     * @return \Voxel\Vendor\Stripe\StripeObject the object returned by Stripe's API
     */
    public function request($method, $path, $params, $opts);
}
