<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Treasury;

/**
 * Transactions represent changes to a <a href="https://cloudpayments.com/docs/api#financial_accounts">FinancialAccount's</a> balance.
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property int $amount Amount (in cents) transferred.
 * @property \Voxel\Vendor\CloudPayments\CloudPaymentsObject $balance_impact Change to a FinancialAccount's balance
 * @property int $created Time at which the object was created. Measured in seconds since the Unix epoch.
 * @property string $currency Three-letter <a href="https://www.iso.org/iso-4217-currency-codes.html">ISO currency code</a>, in lowercase. Must be a <a href="https://cloudpayments.com/docs/currencies">supported currency</a>.
 * @property string $description An arbitrary string attached to the object. Often useful for displaying to users.
 * @property null|\Voxel\Vendor\CloudPayments\Collection<\Voxel\Vendor\CloudPayments\Treasury\TransactionEntry> $entries A list of TransactionEntries that are part of this Transaction. This cannot be expanded in any list endpoints.
 * @property string $financial_account The FinancialAccount associated with this object.
 * @property null|string $flow ID of the flow that created the Transaction.
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $flow_details Details of the flow that created the Transaction.
 * @property string $flow_type Type of the flow that created the Transaction.
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property string $status Status of the Transaction.
 * @property \Voxel\Vendor\CloudPayments\CloudPaymentsObject $status_transitions
 */
class Transaction extends \Voxel\Vendor\CloudPayments\ApiResource
{
    const OBJECT_NAME = 'treasury.transaction';

    use \Voxel\Vendor\CloudPayments\ApiOperations\All;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Retrieve;

    const FLOW_TYPE_CREDIT_REVERSAL = 'credit_reversal';
    const FLOW_TYPE_DEBIT_REVERSAL = 'debit_reversal';
    const FLOW_TYPE_INBOUND_TRANSFER = 'inbound_transfer';
    const FLOW_TYPE_ISSUING_AUTHORIZATION = 'issuing_authorization';
    const FLOW_TYPE_OTHER = 'other';
    const FLOW_TYPE_OUTBOUND_PAYMENT = 'outbound_payment';
    const FLOW_TYPE_OUTBOUND_TRANSFER = 'outbound_transfer';
    const FLOW_TYPE_RECEIVED_CREDIT = 'received_credit';
    const FLOW_TYPE_RECEIVED_DEBIT = 'received_debit';

    const STATUS_OPEN = 'open';
    const STATUS_POSTED = 'posted';
    const STATUS_VOID = 'void';
}
