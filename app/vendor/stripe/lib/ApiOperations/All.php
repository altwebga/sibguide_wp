<?php

namespace Voxel\Vendor\Stripe\ApiOperations;

/**
 * Trait for listable resources. Adds a `all()` static method to the class.
 *
 * This trait should only be applied to classes that derive from StripeObject.
 */
trait All
{
    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Voxel\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\Stripe\Collection of ApiResources
     */
    public static function all($params = null, $opts = null)
    {
        $url = static::classUrl();

        return static::_requestPage($url, \Voxel\Vendor\Stripe\Collection::class, $params, $opts);
    }
}
