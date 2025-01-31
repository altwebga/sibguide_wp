<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\Stripe\Terminal;

/**
 * A Configurations object represents how features should be configured for terminal readers.
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property null|\Voxel\Vendor\Stripe\StripeObject $bbpos_wisepos_e
 * @property null|bool $is_account_default Whether this Configuration is the default for your account
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property null|\Voxel\Vendor\Stripe\StripeObject $offline
 * @property null|\Voxel\Vendor\Stripe\StripeObject $tipping
 * @property null|\Voxel\Vendor\Stripe\StripeObject $verifone_p400
 */
class Configuration extends \Voxel\Vendor\Stripe\ApiResource
{
    const OBJECT_NAME = 'terminal.configuration';

    use \Voxel\Vendor\Stripe\ApiOperations\All;
    use \Voxel\Vendor\Stripe\ApiOperations\Create;
    use \Voxel\Vendor\Stripe\ApiOperations\Delete;
    use \Voxel\Vendor\Stripe\ApiOperations\Retrieve;
    use \Voxel\Vendor\Stripe\ApiOperations\Update;
}
