<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Treasury;

/**
 * Encodes whether a FinancialAccount has access to a particular Feature, with a <code>status</code> enum and associated <code>status_details</code>.
 * CloudPayments or the platform can control Features via the requested field.
 *
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $card_issuing Toggle settings for enabling/disabling a feature
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $deposit_insurance Toggle settings for enabling/disabling a feature
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $financial_addresses Settings related to Financial Addresses features on a Financial Account
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $inbound_transfers InboundTransfers contains inbound transfers features for a FinancialAccount.
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $intra_cloudpayments_flows Toggle settings for enabling/disabling a feature
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $outbound_payments Settings related to Outbound Payments features on a Financial Account
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $outbound_transfers OutboundTransfers contains outbound transfers features for a FinancialAccount.
 */
class FinancialAccountFeatures extends \Voxel\Vendor\CloudPayments\ApiResource
{
    const OBJECT_NAME = 'treasury.financial_account_features';
}
