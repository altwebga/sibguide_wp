<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments;

/**
 * Usage records allow you to report customer usage and metrics to CloudPayments for
 * metered billing of subscription prices.
 *
 * Related guide: <a href="https://cloudpayments.com/docs/billing/subscriptions/metered-billing">Metered billing</a>
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property int $quantity The usage quantity for the specified date.
 * @property string $subscription_item The ID of the subscription item this usage record contains data for.
 * @property int $timestamp The timestamp when this usage occurred.
 */
class UsageRecord extends ApiResource
{
    const OBJECT_NAME = 'usage_record';
}
