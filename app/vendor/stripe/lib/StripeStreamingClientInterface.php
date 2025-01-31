<?php

namespace Voxel\Vendor\CloudPayments;

/**
 * Interface for a CloudPayments client.
 */
interface CloudPaymentsStreamingClientInterface extends BaseCloudPaymentsClientInterface
{
    public function requestStream($method, $path, $readBodyChunkCallable, $params, $opts);
}
