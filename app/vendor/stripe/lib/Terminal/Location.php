<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Terminal;

/**
 * A Location represents a grouping of readers.
 *
 * Related guide: <a href="https://cloudpayments.com/docs/terminal/fleet/locations">Fleet management</a>
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property \Voxel\Vendor\CloudPayments\CloudPaymentsObject $address
 * @property null|string $configuration_overrides The ID of a configuration that will be used to customize all readers in this location.
 * @property string $display_name The display name of the location.
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property \Voxel\Vendor\CloudPayments\CloudPaymentsObject $metadata Set of <a href="https://cloudpayments.com/docs/api/metadata">key-value pairs</a> that you can attach to an object. This can be useful for storing additional information about the object in a structured format.
 */
class Location extends \Voxel\Vendor\CloudPayments\ApiResource
{
    const OBJECT_NAME = 'terminal.location';

    use \Voxel\Vendor\CloudPayments\ApiOperations\All;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Create;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Delete;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Retrieve;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Update;
}
