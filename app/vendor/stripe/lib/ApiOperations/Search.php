<?php

namespace Voxel\Vendor\CloudPayments\ApiOperations;

/**
 * Trait for searchable resources.
 *
 * This trait should only be applied to classes that derive from CloudPaymentsObject.
 */
trait Search
{
    /**
     * @param string $searchUrl
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\SearchResult of ApiResources
     */
    protected static function _searchResource($searchUrl, $params = null, $opts = null)
    {
        return static::_requestPage($searchUrl, \Voxel\Vendor\CloudPayments\SearchResult::class, $params, $opts);
    }
}
