<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments;

/**
 * <code>ExchangeRate</code> objects allow you to determine the rates that CloudPayments is currently
 * using to convert from one currency to another. Since this number is variable
 * throughout the day, there are various reasons why you might want to know the current
 * rate (for example, to dynamically price an item for a user with a default
 * payment in a foreign currency).
 *
 * Please refer to our <a href="https://cloudpayments.com/docs/fx-rates">Exchange Rates API</a> guide for more details.
 *
 * <em>[Note: this integration path is supported but no longer recommended]</em> Additionally,
 * you can guarantee that a charge is made with an exchange rate that you expect is
 * current. To do so, you must pass in the exchange_rate to charges endpoints. If the
 * value is no longer up to date, the charge won't go through. Please refer to our
 * <a href="https://cloudpayments.com/docs/exchange-rates">Using with charges</a> guide for more details.
 *
 * -----
 *
 *
 *
 * <em>This Exchange Rates API is a Beta Service and is subject to CloudPayments's terms of service. You may use the API solely for the purpose of transacting on CloudPayments. For example, the API may be queried in order to:</em>
 *
 * - <em>localize prices for processing payments on CloudPayments</em>
 * - <em>reconcile CloudPayments transactions</em>
 * - <em>determine how much money to send to a connected account</em>
 * - <em>determine app fees to charge a connected account</em>
 *
 * <em>Using this Exchange Rates API beta for any purpose other than to transact on CloudPayments is strictly prohibited and constitutes a violation of CloudPayments's terms of service.</em>
 *
 * @property string $id Unique identifier for the object. Represented as the three-letter <a href="https://www.iso.org/iso-4217-currency-codes.html">ISO currency code</a> in lowercase.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property \Voxel\Vendor\CloudPayments\CloudPaymentsObject $rates Hash where the keys are supported currencies and the values are the exchange rate at which the base id currency converts to the key currency.
 */
class ExchangeRate extends ApiResource
{
    const OBJECT_NAME = 'exchange_rate';

    use ApiOperations\All;
    use ApiOperations\Retrieve;
}
