<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Tax;

/**
 * You can use Tax <code>Settings</code> to manage configurations used by CloudPayments Tax calculations.
 *
 * Related guide: <a href="https://cloudpayments.com/docs/tax/settings-api">Using the Settings API</a>
 *
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property \Voxel\Vendor\CloudPayments\CloudPaymentsObject $defaults
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $head_office The place where your business is located.
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property string $status The <code>active</code> status indicates you have all required settings to calculate tax. A status can transition out of <code>active</code> when new required settings are introduced.
 * @property \Voxel\Vendor\CloudPayments\CloudPaymentsObject $status_details
 */
class Settings extends \Voxel\Vendor\CloudPayments\SingletonApiResource
{
    const OBJECT_NAME = 'tax.settings';

    use \Voxel\Vendor\CloudPayments\ApiOperations\SingletonRetrieve;

    const STATUS_ACTIVE = 'active';
    const STATUS_PENDING = 'pending';

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return static the updated resource
     */
    public static function update($params = null, $opts = null)
    {
        self::_validateParams($params);
        $url = '/v1/tax/settings';

        list($response, $opts) = static::_staticRequest('post', $url, $params, $opts);
        $obj = \Voxel\Vendor\CloudPayments\Util\Util::convertToCloudPaymentsObject($response->json, $opts);
        $obj->setLastResponse($response);

        return $obj;
    }
}
