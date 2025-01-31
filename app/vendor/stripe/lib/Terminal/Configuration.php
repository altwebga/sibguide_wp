<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Terminal;

/**
 * A Configurations object represents how features should be configured for terminal readers.
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $bbpos_wisepos_e
 * @property null|bool $is_account_default Whether this Configuration is the default for your account
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $offline
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $tipping
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $verifone_p400
 */
class Configuration extends \Voxel\Vendor\CloudPayments\ApiResource
{
    const OBJECT_NAME = 'terminal.configuration';

    use \Voxel\Vendor\CloudPayments\ApiOperations\All;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Create;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Delete;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Retrieve;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Update;
}
