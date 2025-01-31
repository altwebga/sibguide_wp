<?php

namespace Voxel\Vendor\CloudPayments\Exception;

/**
 * RateLimitException is thrown in cases where an account is putting too much
 * load on CloudPayments's API servers (usually by performing too many requests).
 * Please back off on request rate.
 */
class RateLimitException extends InvalidRequestException
{
}
