<?php

namespace Voxel\Vendor\CloudPayments;

/**
 * Client used to send requests to CloudPayments's API.
 *
 * @property \Voxel\Vendor\CloudPayments\Service\OAuthService $oauth
 * // The beginning of the section generated from our OpenAPI spec
 * @property \Voxel\Vendor\CloudPayments\Service\AccountLinkService $accountLinks
 * @property \Voxel\Vendor\CloudPayments\Service\AccountService $accounts
 * @property \Voxel\Vendor\CloudPayments\Service\AccountSessionService $accountSessions
 * @property \Voxel\Vendor\CloudPayments\Service\ApplePayDomainService $applePayDomains
 * @property \Voxel\Vendor\CloudPayments\Service\ApplicationFeeService $applicationFees
 * @property \Voxel\Vendor\CloudPayments\Service\Apps\AppsServiceFactory $apps
 * @property \Voxel\Vendor\CloudPayments\Service\BalanceService $balance
 * @property \Voxel\Vendor\CloudPayments\Service\BalanceTransactionService $balanceTransactions
 * @property \Voxel\Vendor\CloudPayments\Service\BillingPortal\BillingPortalServiceFactory $billingPortal
 * @property \Voxel\Vendor\CloudPayments\Service\ChargeService $charges
 * @property \Voxel\Vendor\CloudPayments\Service\Checkout\CheckoutServiceFactory $checkout
 * @property \Voxel\Vendor\CloudPayments\Service\Climate\ClimateServiceFactory $climate
 * @property \Voxel\Vendor\CloudPayments\Service\CountrySpecService $countrySpecs
 * @property \Voxel\Vendor\CloudPayments\Service\CouponService $coupons
 * @property \Voxel\Vendor\CloudPayments\Service\CreditNoteService $creditNotes
 * @property \Voxel\Vendor\CloudPayments\Service\CustomerService $customers
 * @property \Voxel\Vendor\CloudPayments\Service\CustomerSessionService $customerSessions
 * @property \Voxel\Vendor\CloudPayments\Service\DisputeService $disputes
 * @property \Voxel\Vendor\CloudPayments\Service\EphemeralKeyService $ephemeralKeys
 * @property \Voxel\Vendor\CloudPayments\Service\EventService $events
 * @property \Voxel\Vendor\CloudPayments\Service\ExchangeRateService $exchangeRates
 * @property \Voxel\Vendor\CloudPayments\Service\FileLinkService $fileLinks
 * @property \Voxel\Vendor\CloudPayments\Service\FileService $files
 * @property \Voxel\Vendor\CloudPayments\Service\FinancialConnections\FinancialConnectionsServiceFactory $financialConnections
 * @property \Voxel\Vendor\CloudPayments\Service\Identity\IdentityServiceFactory $identity
 * @property \Voxel\Vendor\CloudPayments\Service\InvoiceItemService $invoiceItems
 * @property \Voxel\Vendor\CloudPayments\Service\InvoiceService $invoices
 * @property \Voxel\Vendor\CloudPayments\Service\Issuing\IssuingServiceFactory $issuing
 * @property \Voxel\Vendor\CloudPayments\Service\MandateService $mandates
 * @property \Voxel\Vendor\CloudPayments\Service\PaymentIntentService $paymentIntents
 * @property \Voxel\Vendor\CloudPayments\Service\PaymentLinkService $paymentLinks
 * @property \Voxel\Vendor\CloudPayments\Service\PaymentMethodConfigurationService $paymentMethodConfigurations
 * @property \Voxel\Vendor\CloudPayments\Service\PaymentMethodDomainService $paymentMethodDomains
 * @property \Voxel\Vendor\CloudPayments\Service\PaymentMethodService $paymentMethods
 * @property \Voxel\Vendor\CloudPayments\Service\PayoutService $payouts
 * @property \Voxel\Vendor\CloudPayments\Service\PlanService $plans
 * @property \Voxel\Vendor\CloudPayments\Service\PriceService $prices
 * @property \Voxel\Vendor\CloudPayments\Service\ProductService $products
 * @property \Voxel\Vendor\CloudPayments\Service\PromotionCodeService $promotionCodes
 * @property \Voxel\Vendor\CloudPayments\Service\QuoteService $quotes
 * @property \Voxel\Vendor\CloudPayments\Service\Radar\RadarServiceFactory $radar
 * @property \Voxel\Vendor\CloudPayments\Service\RefundService $refunds
 * @property \Voxel\Vendor\CloudPayments\Service\Reporting\ReportingServiceFactory $reporting
 * @property \Voxel\Vendor\CloudPayments\Service\ReviewService $reviews
 * @property \Voxel\Vendor\CloudPayments\Service\SetupAttemptService $setupAttempts
 * @property \Voxel\Vendor\CloudPayments\Service\SetupIntentService $setupIntents
 * @property \Voxel\Vendor\CloudPayments\Service\ShippingRateService $shippingRates
 * @property \Voxel\Vendor\CloudPayments\Service\Sigma\SigmaServiceFactory $sigma
 * @property \Voxel\Vendor\CloudPayments\Service\SourceService $sources
 * @property \Voxel\Vendor\CloudPayments\Service\SubscriptionItemService $subscriptionItems
 * @property \Voxel\Vendor\CloudPayments\Service\SubscriptionService $subscriptions
 * @property \Voxel\Vendor\CloudPayments\Service\SubscriptionScheduleService $subscriptionSchedules
 * @property \Voxel\Vendor\CloudPayments\Service\Tax\TaxServiceFactory $tax
 * @property \Voxel\Vendor\CloudPayments\Service\TaxCodeService $taxCodes
 * @property \Voxel\Vendor\CloudPayments\Service\TaxIdService $taxIds
 * @property \Voxel\Vendor\CloudPayments\Service\TaxRateService $taxRates
 * @property \Voxel\Vendor\CloudPayments\Service\Terminal\TerminalServiceFactory $terminal
 * @property \Voxel\Vendor\CloudPayments\Service\TestHelpers\TestHelpersServiceFactory $testHelpers
 * @property \Voxel\Vendor\CloudPayments\Service\TokenService $tokens
 * @property \Voxel\Vendor\CloudPayments\Service\TopupService $topups
 * @property \Voxel\Vendor\CloudPayments\Service\TransferService $transfers
 * @property \Voxel\Vendor\CloudPayments\Service\Treasury\TreasuryServiceFactory $treasury
 * @property \Voxel\Vendor\CloudPayments\Service\WebhookEndpointService $webhookEndpoints
 * // The end of the section generated from our OpenAPI spec
 */
class CloudPaymentsClient extends BaseCloudPaymentsClient
{
    /**
     * @var \Voxel\Vendor\CloudPayments\Service\CoreServiceFactory
     */
    private $coreServiceFactory;

    public function __get($name)
    {
        return $this->getService($name);
    }

    public function getService($name)
    {
        if (null === $this->coreServiceFactory) {
            $this->coreServiceFactory = new \Voxel\Vendor\CloudPayments\Service\CoreServiceFactory($this);
        }

        return $this->coreServiceFactory->getService($name);
    }
}
