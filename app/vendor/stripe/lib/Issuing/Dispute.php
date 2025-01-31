<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Issuing;

/**
 * As a <a href="https://cloudpayments.com/docs/issuing">card issuer</a>, you can dispute transactions that the cardholder does not recognize, suspects to be fraudulent, or has other issues with.
 *
 * Related guide: <a href="https://cloudpayments.com/docs/issuing/purchases/disputes">Issuing disputes</a>
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property int $amount Disputed amount in the card's currency and in the <a href="https://cloudpayments.com/docs/currencies#zero-decimal">smallest currency unit</a>. Usually the amount of the <code>transaction</code>, but can differ (usually because of currency fluctuation).
 * @property null|\Voxel\Vendor\CloudPayments\BalanceTransaction[] $balance_transactions List of balance transactions associated with the dispute.
 * @property int $created Time at which the object was created. Measured in seconds since the Unix epoch.
 * @property string $currency The currency the <code>transaction</code> was made in.
 * @property \Voxel\Vendor\CloudPayments\CloudPaymentsObject $evidence
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property \Voxel\Vendor\CloudPayments\CloudPaymentsObject $metadata Set of <a href="https://cloudpayments.com/docs/api/metadata">key-value pairs</a> that you can attach to an object. This can be useful for storing additional information about the object in a structured format.
 * @property string $status Current status of the dispute.
 * @property string|\Voxel\Vendor\CloudPayments\Issuing\Transaction $transaction The transaction being disputed.
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $treasury <a href="https://cloudpayments.com/docs/api/treasury">Treasury</a> details related to this dispute if it was created on a [FinancialAccount](/docs/api/treasury/financial_accounts
 */
class Dispute extends \Voxel\Vendor\CloudPayments\ApiResource
{
    const OBJECT_NAME = 'issuing.dispute';

    use \Voxel\Vendor\CloudPayments\ApiOperations\All;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Create;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Retrieve;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Update;

    const STATUS_EXPIRED = 'expired';
    const STATUS_LOST = 'lost';
    const STATUS_SUBMITTED = 'submitted';
    const STATUS_UNSUBMITTED = 'unsubmitted';
    const STATUS_WON = 'won';

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Voxel\Vendor\CloudPayments\Exception\ApiErrorException if the request fails
     *
     * @return \Voxel\Vendor\CloudPayments\Issuing\Dispute the submited dispute
     */
    public function submit($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/submit';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);

        return $this;
    }
}
