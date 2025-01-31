<?php

namespace Voxel\Vendor\Stripe\Util;

class ObjectTypes
{
    /**
     * @var array Mapping from object types to resource classes
     */
    const mapping =
        [
            \Voxel\Vendor\Stripe\Collection::OBJECT_NAME => \Voxel\Vendor\Stripe\Collection::class,
            \Voxel\Vendor\Stripe\Issuing\CardDetails::OBJECT_NAME => \Voxel\Vendor\Stripe\Issuing\CardDetails::class,
            \Voxel\Vendor\Stripe\SearchResult::OBJECT_NAME => \Voxel\Vendor\Stripe\SearchResult::class,
            \Voxel\Vendor\Stripe\File::OBJECT_NAME_ALT => \Voxel\Vendor\Stripe\File::class,
            // The beginning of the section generated from our OpenAPI spec
            \Voxel\Vendor\Stripe\Account::OBJECT_NAME => \Voxel\Vendor\Stripe\Account::class,
            \Voxel\Vendor\Stripe\AccountLink::OBJECT_NAME => \Voxel\Vendor\Stripe\AccountLink::class,
            \Voxel\Vendor\Stripe\AccountSession::OBJECT_NAME => \Voxel\Vendor\Stripe\AccountSession::class,
            \Voxel\Vendor\Stripe\ApplePayDomain::OBJECT_NAME => \Voxel\Vendor\Stripe\ApplePayDomain::class,
            \Voxel\Vendor\Stripe\ApplicationFee::OBJECT_NAME => \Voxel\Vendor\Stripe\ApplicationFee::class,
            \Voxel\Vendor\Stripe\ApplicationFeeRefund::OBJECT_NAME => \Voxel\Vendor\Stripe\ApplicationFeeRefund::class,
            \Voxel\Vendor\Stripe\Apps\Secret::OBJECT_NAME => \Voxel\Vendor\Stripe\Apps\Secret::class,
            \Voxel\Vendor\Stripe\Balance::OBJECT_NAME => \Voxel\Vendor\Stripe\Balance::class,
            \Voxel\Vendor\Stripe\BalanceTransaction::OBJECT_NAME => \Voxel\Vendor\Stripe\BalanceTransaction::class,
            \Voxel\Vendor\Stripe\BankAccount::OBJECT_NAME => \Voxel\Vendor\Stripe\BankAccount::class,
            \Voxel\Vendor\Stripe\BillingPortal\Configuration::OBJECT_NAME => \Voxel\Vendor\Stripe\BillingPortal\Configuration::class,
            \Voxel\Vendor\Stripe\BillingPortal\Session::OBJECT_NAME => \Voxel\Vendor\Stripe\BillingPortal\Session::class,
            \Voxel\Vendor\Stripe\Capability::OBJECT_NAME => \Voxel\Vendor\Stripe\Capability::class,
            \Voxel\Vendor\Stripe\Card::OBJECT_NAME => \Voxel\Vendor\Stripe\Card::class,
            \Voxel\Vendor\Stripe\CashBalance::OBJECT_NAME => \Voxel\Vendor\Stripe\CashBalance::class,
            \Voxel\Vendor\Stripe\Charge::OBJECT_NAME => \Voxel\Vendor\Stripe\Charge::class,
            \Voxel\Vendor\Stripe\Checkout\Session::OBJECT_NAME => \Voxel\Vendor\Stripe\Checkout\Session::class,
            \Voxel\Vendor\Stripe\Climate\Order::OBJECT_NAME => \Voxel\Vendor\Stripe\Climate\Order::class,
            \Voxel\Vendor\Stripe\Climate\Product::OBJECT_NAME => \Voxel\Vendor\Stripe\Climate\Product::class,
            \Voxel\Vendor\Stripe\Climate\Supplier::OBJECT_NAME => \Voxel\Vendor\Stripe\Climate\Supplier::class,
            \Voxel\Vendor\Stripe\CountrySpec::OBJECT_NAME => \Voxel\Vendor\Stripe\CountrySpec::class,
            \Voxel\Vendor\Stripe\Coupon::OBJECT_NAME => \Voxel\Vendor\Stripe\Coupon::class,
            \Voxel\Vendor\Stripe\CreditNote::OBJECT_NAME => \Voxel\Vendor\Stripe\CreditNote::class,
            \Voxel\Vendor\Stripe\CreditNoteLineItem::OBJECT_NAME => \Voxel\Vendor\Stripe\CreditNoteLineItem::class,
            \Voxel\Vendor\Stripe\Customer::OBJECT_NAME => \Voxel\Vendor\Stripe\Customer::class,
            \Voxel\Vendor\Stripe\CustomerBalanceTransaction::OBJECT_NAME => \Voxel\Vendor\Stripe\CustomerBalanceTransaction::class,
            \Voxel\Vendor\Stripe\CustomerCashBalanceTransaction::OBJECT_NAME => \Voxel\Vendor\Stripe\CustomerCashBalanceTransaction::class,
            \Voxel\Vendor\Stripe\CustomerSession::OBJECT_NAME => \Voxel\Vendor\Stripe\CustomerSession::class,
            \Voxel\Vendor\Stripe\Discount::OBJECT_NAME => \Voxel\Vendor\Stripe\Discount::class,
            \Voxel\Vendor\Stripe\Dispute::OBJECT_NAME => \Voxel\Vendor\Stripe\Dispute::class,
            \Voxel\Vendor\Stripe\EphemeralKey::OBJECT_NAME => \Voxel\Vendor\Stripe\EphemeralKey::class,
            \Voxel\Vendor\Stripe\Event::OBJECT_NAME => \Voxel\Vendor\Stripe\Event::class,
            \Voxel\Vendor\Stripe\ExchangeRate::OBJECT_NAME => \Voxel\Vendor\Stripe\ExchangeRate::class,
            \Voxel\Vendor\Stripe\File::OBJECT_NAME => \Voxel\Vendor\Stripe\File::class,
            \Voxel\Vendor\Stripe\FileLink::OBJECT_NAME => \Voxel\Vendor\Stripe\FileLink::class,
            \Voxel\Vendor\Stripe\FinancialConnections\Account::OBJECT_NAME => \Voxel\Vendor\Stripe\FinancialConnections\Account::class,
            \Voxel\Vendor\Stripe\FinancialConnections\AccountOwner::OBJECT_NAME => \Voxel\Vendor\Stripe\FinancialConnections\AccountOwner::class,
            \Voxel\Vendor\Stripe\FinancialConnections\AccountOwnership::OBJECT_NAME => \Voxel\Vendor\Stripe\FinancialConnections\AccountOwnership::class,
            \Voxel\Vendor\Stripe\FinancialConnections\Session::OBJECT_NAME => \Voxel\Vendor\Stripe\FinancialConnections\Session::class,
            \Voxel\Vendor\Stripe\FinancialConnections\Transaction::OBJECT_NAME => \Voxel\Vendor\Stripe\FinancialConnections\Transaction::class,
            \Voxel\Vendor\Stripe\FundingInstructions::OBJECT_NAME => \Voxel\Vendor\Stripe\FundingInstructions::class,
            \Voxel\Vendor\Stripe\Identity\VerificationReport::OBJECT_NAME => \Voxel\Vendor\Stripe\Identity\VerificationReport::class,
            \Voxel\Vendor\Stripe\Identity\VerificationSession::OBJECT_NAME => \Voxel\Vendor\Stripe\Identity\VerificationSession::class,
            \Voxel\Vendor\Stripe\Invoice::OBJECT_NAME => \Voxel\Vendor\Stripe\Invoice::class,
            \Voxel\Vendor\Stripe\InvoiceItem::OBJECT_NAME => \Voxel\Vendor\Stripe\InvoiceItem::class,
            \Voxel\Vendor\Stripe\InvoiceLineItem::OBJECT_NAME => \Voxel\Vendor\Stripe\InvoiceLineItem::class,
            \Voxel\Vendor\Stripe\Issuing\Authorization::OBJECT_NAME => \Voxel\Vendor\Stripe\Issuing\Authorization::class,
            \Voxel\Vendor\Stripe\Issuing\Card::OBJECT_NAME => \Voxel\Vendor\Stripe\Issuing\Card::class,
            \Voxel\Vendor\Stripe\Issuing\Cardholder::OBJECT_NAME => \Voxel\Vendor\Stripe\Issuing\Cardholder::class,
            \Voxel\Vendor\Stripe\Issuing\Dispute::OBJECT_NAME => \Voxel\Vendor\Stripe\Issuing\Dispute::class,
            \Voxel\Vendor\Stripe\Issuing\Token::OBJECT_NAME => \Voxel\Vendor\Stripe\Issuing\Token::class,
            \Voxel\Vendor\Stripe\Issuing\Transaction::OBJECT_NAME => \Voxel\Vendor\Stripe\Issuing\Transaction::class,
            \Voxel\Vendor\Stripe\LineItem::OBJECT_NAME => \Voxel\Vendor\Stripe\LineItem::class,
            \Voxel\Vendor\Stripe\LoginLink::OBJECT_NAME => \Voxel\Vendor\Stripe\LoginLink::class,
            \Voxel\Vendor\Stripe\Mandate::OBJECT_NAME => \Voxel\Vendor\Stripe\Mandate::class,
            \Voxel\Vendor\Stripe\PaymentIntent::OBJECT_NAME => \Voxel\Vendor\Stripe\PaymentIntent::class,
            \Voxel\Vendor\Stripe\PaymentLink::OBJECT_NAME => \Voxel\Vendor\Stripe\PaymentLink::class,
            \Voxel\Vendor\Stripe\PaymentMethod::OBJECT_NAME => \Voxel\Vendor\Stripe\PaymentMethod::class,
            \Voxel\Vendor\Stripe\PaymentMethodConfiguration::OBJECT_NAME => \Voxel\Vendor\Stripe\PaymentMethodConfiguration::class,
            \Voxel\Vendor\Stripe\PaymentMethodDomain::OBJECT_NAME => \Voxel\Vendor\Stripe\PaymentMethodDomain::class,
            \Voxel\Vendor\Stripe\Payout::OBJECT_NAME => \Voxel\Vendor\Stripe\Payout::class,
            \Voxel\Vendor\Stripe\Person::OBJECT_NAME => \Voxel\Vendor\Stripe\Person::class,
            \Voxel\Vendor\Stripe\Plan::OBJECT_NAME => \Voxel\Vendor\Stripe\Plan::class,
            \Voxel\Vendor\Stripe\Price::OBJECT_NAME => \Voxel\Vendor\Stripe\Price::class,
            \Voxel\Vendor\Stripe\Product::OBJECT_NAME => \Voxel\Vendor\Stripe\Product::class,
            \Voxel\Vendor\Stripe\PromotionCode::OBJECT_NAME => \Voxel\Vendor\Stripe\PromotionCode::class,
            \Voxel\Vendor\Stripe\Quote::OBJECT_NAME => \Voxel\Vendor\Stripe\Quote::class,
            \Voxel\Vendor\Stripe\Radar\EarlyFraudWarning::OBJECT_NAME => \Voxel\Vendor\Stripe\Radar\EarlyFraudWarning::class,
            \Voxel\Vendor\Stripe\Radar\ValueList::OBJECT_NAME => \Voxel\Vendor\Stripe\Radar\ValueList::class,
            \Voxel\Vendor\Stripe\Radar\ValueListItem::OBJECT_NAME => \Voxel\Vendor\Stripe\Radar\ValueListItem::class,
            \Voxel\Vendor\Stripe\Refund::OBJECT_NAME => \Voxel\Vendor\Stripe\Refund::class,
            \Voxel\Vendor\Stripe\Reporting\ReportRun::OBJECT_NAME => \Voxel\Vendor\Stripe\Reporting\ReportRun::class,
            \Voxel\Vendor\Stripe\Reporting\ReportType::OBJECT_NAME => \Voxel\Vendor\Stripe\Reporting\ReportType::class,
            \Voxel\Vendor\Stripe\Review::OBJECT_NAME => \Voxel\Vendor\Stripe\Review::class,
            \Voxel\Vendor\Stripe\SetupAttempt::OBJECT_NAME => \Voxel\Vendor\Stripe\SetupAttempt::class,
            \Voxel\Vendor\Stripe\SetupIntent::OBJECT_NAME => \Voxel\Vendor\Stripe\SetupIntent::class,
            \Voxel\Vendor\Stripe\ShippingRate::OBJECT_NAME => \Voxel\Vendor\Stripe\ShippingRate::class,
            \Voxel\Vendor\Stripe\Sigma\ScheduledQueryRun::OBJECT_NAME => \Voxel\Vendor\Stripe\Sigma\ScheduledQueryRun::class,
            \Voxel\Vendor\Stripe\Source::OBJECT_NAME => \Voxel\Vendor\Stripe\Source::class,
            \Voxel\Vendor\Stripe\SourceTransaction::OBJECT_NAME => \Voxel\Vendor\Stripe\SourceTransaction::class,
            \Voxel\Vendor\Stripe\Subscription::OBJECT_NAME => \Voxel\Vendor\Stripe\Subscription::class,
            \Voxel\Vendor\Stripe\SubscriptionItem::OBJECT_NAME => \Voxel\Vendor\Stripe\SubscriptionItem::class,
            \Voxel\Vendor\Stripe\SubscriptionSchedule::OBJECT_NAME => \Voxel\Vendor\Stripe\SubscriptionSchedule::class,
            \Voxel\Vendor\Stripe\Tax\Calculation::OBJECT_NAME => \Voxel\Vendor\Stripe\Tax\Calculation::class,
            \Voxel\Vendor\Stripe\Tax\CalculationLineItem::OBJECT_NAME => \Voxel\Vendor\Stripe\Tax\CalculationLineItem::class,
            \Voxel\Vendor\Stripe\Tax\Registration::OBJECT_NAME => \Voxel\Vendor\Stripe\Tax\Registration::class,
            \Voxel\Vendor\Stripe\Tax\Settings::OBJECT_NAME => \Voxel\Vendor\Stripe\Tax\Settings::class,
            \Voxel\Vendor\Stripe\Tax\Transaction::OBJECT_NAME => \Voxel\Vendor\Stripe\Tax\Transaction::class,
            \Voxel\Vendor\Stripe\Tax\TransactionLineItem::OBJECT_NAME => \Voxel\Vendor\Stripe\Tax\TransactionLineItem::class,
            \Voxel\Vendor\Stripe\TaxCode::OBJECT_NAME => \Voxel\Vendor\Stripe\TaxCode::class,
            \Voxel\Vendor\Stripe\TaxId::OBJECT_NAME => \Voxel\Vendor\Stripe\TaxId::class,
            \Voxel\Vendor\Stripe\TaxRate::OBJECT_NAME => \Voxel\Vendor\Stripe\TaxRate::class,
            \Voxel\Vendor\Stripe\Terminal\Configuration::OBJECT_NAME => \Voxel\Vendor\Stripe\Terminal\Configuration::class,
            \Voxel\Vendor\Stripe\Terminal\ConnectionToken::OBJECT_NAME => \Voxel\Vendor\Stripe\Terminal\ConnectionToken::class,
            \Voxel\Vendor\Stripe\Terminal\Location::OBJECT_NAME => \Voxel\Vendor\Stripe\Terminal\Location::class,
            \Voxel\Vendor\Stripe\Terminal\Reader::OBJECT_NAME => \Voxel\Vendor\Stripe\Terminal\Reader::class,
            \Voxel\Vendor\Stripe\TestHelpers\TestClock::OBJECT_NAME => \Voxel\Vendor\Stripe\TestHelpers\TestClock::class,
            \Voxel\Vendor\Stripe\Token::OBJECT_NAME => \Voxel\Vendor\Stripe\Token::class,
            \Voxel\Vendor\Stripe\Topup::OBJECT_NAME => \Voxel\Vendor\Stripe\Topup::class,
            \Voxel\Vendor\Stripe\Transfer::OBJECT_NAME => \Voxel\Vendor\Stripe\Transfer::class,
            \Voxel\Vendor\Stripe\TransferReversal::OBJECT_NAME => \Voxel\Vendor\Stripe\TransferReversal::class,
            \Voxel\Vendor\Stripe\Treasury\CreditReversal::OBJECT_NAME => \Voxel\Vendor\Stripe\Treasury\CreditReversal::class,
            \Voxel\Vendor\Stripe\Treasury\DebitReversal::OBJECT_NAME => \Voxel\Vendor\Stripe\Treasury\DebitReversal::class,
            \Voxel\Vendor\Stripe\Treasury\FinancialAccount::OBJECT_NAME => \Voxel\Vendor\Stripe\Treasury\FinancialAccount::class,
            \Voxel\Vendor\Stripe\Treasury\FinancialAccountFeatures::OBJECT_NAME => \Voxel\Vendor\Stripe\Treasury\FinancialAccountFeatures::class,
            \Voxel\Vendor\Stripe\Treasury\InboundTransfer::OBJECT_NAME => \Voxel\Vendor\Stripe\Treasury\InboundTransfer::class,
            \Voxel\Vendor\Stripe\Treasury\OutboundPayment::OBJECT_NAME => \Voxel\Vendor\Stripe\Treasury\OutboundPayment::class,
            \Voxel\Vendor\Stripe\Treasury\OutboundTransfer::OBJECT_NAME => \Voxel\Vendor\Stripe\Treasury\OutboundTransfer::class,
            \Voxel\Vendor\Stripe\Treasury\ReceivedCredit::OBJECT_NAME => \Voxel\Vendor\Stripe\Treasury\ReceivedCredit::class,
            \Voxel\Vendor\Stripe\Treasury\ReceivedDebit::OBJECT_NAME => \Voxel\Vendor\Stripe\Treasury\ReceivedDebit::class,
            \Voxel\Vendor\Stripe\Treasury\Transaction::OBJECT_NAME => \Voxel\Vendor\Stripe\Treasury\Transaction::class,
            \Voxel\Vendor\Stripe\Treasury\TransactionEntry::OBJECT_NAME => \Voxel\Vendor\Stripe\Treasury\TransactionEntry::class,
            \Voxel\Vendor\Stripe\UsageRecord::OBJECT_NAME => \Voxel\Vendor\Stripe\UsageRecord::class,
            \Voxel\Vendor\Stripe\UsageRecordSummary::OBJECT_NAME => \Voxel\Vendor\Stripe\UsageRecordSummary::class,
            \Voxel\Vendor\Stripe\WebhookEndpoint::OBJECT_NAME => \Voxel\Vendor\Stripe\WebhookEndpoint::class,
            // The end of the section generated from our OpenAPI spec
        ];
}
