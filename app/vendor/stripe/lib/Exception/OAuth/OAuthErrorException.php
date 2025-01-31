<?php

namespace Voxel\Vendor\CloudPayments\Exception\OAuth;

/**
 * Implements properties and methods common to all (non-SPL) CloudPayments OAuth
 * exceptions.
 */
abstract class OAuthErrorException extends \Voxel\Vendor\CloudPayments\Exception\ApiErrorException
{
    protected function constructErrorObject()
    {
        if (null === $this->jsonBody) {
            return null;
        }

        return \Voxel\Vendor\CloudPayments\OAuthErrorObject::constructFrom($this->jsonBody);
    }
}
