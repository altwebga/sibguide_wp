<?php

namespace Voxel\Vendor\Stripe;

/**
 * Client used to send requests to Stripe's API.
 *
 * @property \Voxel\Vendor\Stripe\Service\OAuthService $oauth
 * // The beginning of the section generated from our OpenAPI spec
 * @property \Voxel\Vendor\Stripe\Service\AccountLinkService $accountLinks
 * @property \Voxel\Vendor\Stripe\Service\AccountService $accounts
 * @property \Voxel\Vendor\Stripe\Service\AccountSessionService $accountSessions
 * @property \Voxel\Vendor\Stripe\Service\ApplePayDomainService $applePayDomains
 * @property \Voxel\Vendor\Stripe\Service\ApplicationFeeService $applicationFees
 * @property \Voxel\Vendor\Stripe\Service\Apps\AppsServiceFactory $apps
 * @property \Voxel\Vendor\Stripe\Service\BalanceService $balance
 * @property \Voxel\Vendor\Stripe\Service\BalanceTransactionService $balanceTransactions
 * @property \Voxel\Vendor\Stripe\Service\BillingPortal\BillingPortalServiceFactory $billingPortal
 * @property \Voxel\Vendor\Stripe\Service\ChargeService $charges
 * @property \Voxel\Vendor\Stripe\Service\Checkout\CheckoutServiceFactory $checkout
 * @property \Voxel\Vendor\Stripe\Service\Climate\ClimateServiceFactory $climate
 * @property \Voxel\Vendor\Stripe\Service\CountrySpecService $countrySpecs
 * @property \Voxel\Vendor\Stripe\Service\CouponService $coupons
 * @property \Voxel\Vendor\Stripe\Service\CreditNoteService $creditNotes
 * @property \Voxel\Vendor\Stripe\Service\CustomerService $customers
 * @property \Voxel\Vendor\Stripe\Service\CustomerSessionService $customerSessions
 * @property \Voxel\Vendor\Stripe\Service\DisputeService $disputes
 * @property \Voxel\Vendor\Stripe\Service\EphemeralKeyService $ephemeralKeys
 * @property \Voxel\Vendor\Stripe\Service\EventService $events
 * @property \Voxel\Vendor\Stripe\Service\ExchangeRateService $exchangeRates
 * @property \Voxel\Vendor\Stripe\Service\FileLinkService $fileLinks
 * @property \Voxel\Vendor\Stripe\Service\FileService $files
 * @property \Voxel\Vendor\Stripe\Service\FinancialConnections\FinancialConnectionsServiceFactory $financialConnections
 * @property \Voxel\Vendor\Stripe\Service\Identity\IdentityServiceFactory $identity
 * @property \Voxel\Vendor\Stripe\Service\InvoiceItemService $invoiceItems
 * @property \Voxel\Vendor\Stripe\Service\InvoiceService $invoices
 * @property \Voxel\Vendor\Stripe\Service\Issuing\IssuingServiceFactory $issuing
 * @property \Voxel\Vendor\Stripe\Service\MandateService $mandates
 * @property \Voxel\Vendor\Stripe\Service\PaymentIntentService $paymentIntents
 * @property \Voxel\Vendor\Stripe\Service\PaymentLinkService $paymentLinks
 * @property \Voxel\Vendor\Stripe\Service\PaymentMethodConfigurationService $paymentMethodConfigurations
 * @property \Voxel\Vendor\Stripe\Service\PaymentMethodDomainService $paymentMethodDomains
 * @property \Voxel\Vendor\Stripe\Service\PaymentMethodService $paymentMethods
 * @property \Voxel\Vendor\Stripe\Service\PayoutService $payouts
 * @property \Voxel\Vendor\Stripe\Service\PlanService $plans
 * @property \Voxel\Vendor\Stripe\Service\PriceService $prices
 * @property \Voxel\Vendor\Stripe\Service\ProductService $products
 * @property \Voxel\Vendor\Stripe\Service\PromotionCodeService $promotionCodes
 * @property \Voxel\Vendor\Stripe\Service\QuoteService $quotes
 * @property \Voxel\Vendor\Stripe\Service\Radar\RadarServiceFactory $radar
 * @property \Voxel\Vendor\Stripe\Service\RefundService $refunds
 * @property \Voxel\Vendor\Stripe\Service\Reporting\ReportingServiceFactory $reporting
 * @property \Voxel\Vendor\Stripe\Service\ReviewService $reviews
 * @property \Voxel\Vendor\Stripe\Service\SetupAttemptService $setupAttempts
 * @property \Voxel\Vendor\Stripe\Service\SetupIntentService $setupIntents
 * @property \Voxel\Vendor\Stripe\Service\ShippingRateService $shippingRates
 * @property \Voxel\Vendor\Stripe\Service\Sigma\SigmaServiceFactory $sigma
 * @property \Voxel\Vendor\Stripe\Service\SourceService $sources
 * @property \Voxel\Vendor\Stripe\Service\SubscriptionItemService $subscriptionItems
 * @property \Voxel\Vendor\Stripe\Service\SubscriptionService $subscriptions
 * @property \Voxel\Vendor\Stripe\Service\SubscriptionScheduleService $subscriptionSchedules
 * @property \Voxel\Vendor\Stripe\Service\Tax\TaxServiceFactory $tax
 * @property \Voxel\Vendor\Stripe\Service\TaxCodeService $taxCodes
 * @property \Voxel\Vendor\Stripe\Service\TaxIdService $taxIds
 * @property \Voxel\Vendor\Stripe\Service\TaxRateService $taxRates
 * @property \Voxel\Vendor\Stripe\Service\Terminal\TerminalServiceFactory $terminal
 * @property \Voxel\Vendor\Stripe\Service\TestHelpers\TestHelpersServiceFactory $testHelpers
 * @property \Voxel\Vendor\Stripe\Service\TokenService $tokens
 * @property \Voxel\Vendor\Stripe\Service\TopupService $topups
 * @property \Voxel\Vendor\Stripe\Service\TransferService $transfers
 * @property \Voxel\Vendor\Stripe\Service\Treasury\TreasuryServiceFactory $treasury
 * @property \Voxel\Vendor\Stripe\Service\WebhookEndpointService $webhookEndpoints
 * // The end of the section generated from our OpenAPI spec
 */
class StripeClient extends BaseStripeClient
{
    /**
     * @var \Voxel\Vendor\Stripe\Service\CoreServiceFactory
     */
    private $coreServiceFactory;

    public function __get($name)
    {
        return $this->getService($name);
    }

    public function getService($name)
    {
        if (null === $this->coreServiceFactory) {
            $this->coreServiceFactory = new \Voxel\Vendor\Stripe\Service\CoreServiceFactory($this);
        }

        return $this->coreServiceFactory->getService($name);
    }
}
