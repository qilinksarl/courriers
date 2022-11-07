<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGateway;
use App\DataTransferObjects\TransactionRedirectData;
use HiPay\Fullservice\Enum\ThreeDSTwo\DeliveryTimeFrame;
use HiPay\Fullservice\Enum\ThreeDSTwo\DeviceChannel;
use HiPay\Fullservice\Enum\ThreeDSTwo\NameIndicator;
use HiPay\Fullservice\Enum\ThreeDSTwo\PurchaseIndicator;
use HiPay\Fullservice\Enum\ThreeDSTwo\ReorderIndicator;
use HiPay\Fullservice\Enum\ThreeDSTwo\ShippingIndicator;
use HiPay\Fullservice\Enum\Transaction\TransactionState;
use HiPay\Fullservice\Gateway\Client\GatewayClient;
use HiPay\Fullservice\Gateway\Model\Request\ThreeDSTwo\AccountInfo;
use HiPay\Fullservice\Gateway\Model\Request\ThreeDSTwo\AccountInfo\Customer;
use HiPay\Fullservice\Gateway\Model\Request\ThreeDSTwo\AccountInfo\Payment;
use HiPay\Fullservice\Gateway\Model\Request\ThreeDSTwo\AccountInfo\Purchase;
use HiPay\Fullservice\Gateway\Model\Request\ThreeDSTwo\AccountInfo\Shipping;
use HiPay\Fullservice\Gateway\Model\Request\ThreeDSTwo\BrowserInfo;
use HiPay\Fullservice\Gateway\Model\Request\ThreeDSTwo\MerchantRiskStatement;
use HiPay\Fullservice\Gateway\Model\Request\ThreeDSTwo\PreviousAuthInfo;
use HiPay\Fullservice\Gateway\Request\Order\OrderRequest;
use HiPay\Fullservice\Gateway\Request\PaymentMethod\CardTokenPaymentMethod;
use HiPay\Fullservice\HTTP\Configuration\Configuration;
use HiPay\Fullservice\HTTP\SimpleHTTPClient;

class HipayDriver implements PaymentGateway
{
    private GatewayClient $gatewayClient;
    private int $eci;

    private const TRANSACTION = 7;
    private const RECURRING_TRANSACTION = 9;
    private const CURRENCY = 'EUR';

    /**
     * @throws \Exception
     */
    public function __construct(
        private string $user,
        private string $password,
        private string $env,
    )
    {
        $this->gatewayClient = new GatewayClient(
            new SimpleHTTPClient(
                new Configuration([
                    "apiUsername" => $this->user,
                    "apiPassword" => $this->password,
                    "apiEnv" => $this->env === 'production' ? Configuration::API_ENDPOINT_PROD : Configuration::API_ENV_STAGE,
                ])
            )
        );

        $this->eci = self::TRANSACTION;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Hipay';
    }

    public function authorize()
    {
        // TODO: Implement authorize() method.
    }

    /**
     * @param array $payload
     * @return TransactionRedirectData
     */
    public function capture(array $payload): TransactionRedirectData
    {
        $transaction = $this->gatewayClient->requestNewOrder(
            $this->orderRequest($payload)
        );

        $forwardUrl = $transaction->getForwardUrl();

        switch($transaction->getState()) {
            case TransactionState::COMPLETED:
            case TransactionState::PENDING:
                $redirect = new TransactionRedirectData(
                    status: 200,
                    url: route('')
                );
                break;
            case TransactionState::FORWARDING:
                $redirect = new TransactionRedirectData(
                    status: 200,
                    url: $forwardUrl
                );
                break;
            case TransactionState::DECLINED:
            case TransactionState::ERROR:
                $reason = $transaction->getReason();

                $redirect = new TransactionRedirectData(
                    status: 500,
                    url: route(''),
                    message: 'An error occured, process has been cancelled.'
                );
                break;
            default:
                $redirect = new TransactionRedirectData(
                    status: 500,
                    url: route(''),
                    message: 'An error occured, process has been cancelled.'
                );
        }

        return $redirect;
    }

    /**
     * @param bool $isSubscription
     * @return void
     */
    public function isSubscription(bool $isSubscription = false): void
    {
        $this->eci = $isSubscription ? self::RECURRING_TRANSACTION : self::TRANSACTION;
    }

    /**
     * @return CardTokenPaymentMethod
     */
    private function cardTokenPaymentMethod(): CardTokenPaymentMethod
    {
        $paymentMethod = new CardTokenPaymentMethod();
        $paymentMethod->cardtoken = '';
        $paymentMethod->eci = $this->eci;
        $paymentMethod->authentication_indicator = 0;

        return $paymentMethod;
    }

    /**
     * @param array $order
     * @return OrderRequest
     */
    private function orderRequest(array $order): OrderRequest
    {
        $orderRequest = new OrderRequest();
        $orderRequest->orderid = '';
        $orderRequest->operation = '';
        $orderRequest->payment_product = '';
        $orderRequest->description = '';
        $orderRequest->currency = self::CURRENCY;
        $orderRequest->amount = 0.0;
        $orderRequest->shipping = 0.0;
        $orderRequest->tax = 0.0;
        $orderRequest->cid = '';
        $orderRequest->ipaddr = '';
        $orderRequest->accept_url = '';
        $orderRequest->decline_url = '';
        $orderRequest->pending_url = '';
        $orderRequest->exception_url = '';
        $orderRequest->cancel_url = '';
        $orderRequest->http_accept = '';
        $orderRequest->http_user_agent = '';
        $orderRequest->language = '';
        $orderRequest->custom_data = '';
        $orderRequest->device_channel = DeviceChannel::BROWSER;
        $orderRequest->browser_info = $this->browserInfo();
        $orderRequest->account_info = $this->accountInfo();
        $orderRequest->previous_auth_info = $this->previousAuthInfo();
        $orderRequest->merchant_risk_statement = $this->merchantRiskStatement();
        $orderRequest->paymentMethod = $this->cardTokenPaymentMethod();

        return $orderRequest;
    }

    /**
     * @return AccountInfo
     */
    private function accountInfo(): AccountInfo
    {
        $accountInfo = new AccountInfo();
        $accountInfo->customer = $this->customerInfo();
        $accountInfo->purchase = $this->purchaseInfo();
        $accountInfo->payment = $this->paymentInfo();
        $accountInfo->shipping = $this->shippingInfo();

        return $accountInfo;
    }

    /**
     * @return Customer
     */
    private function customerInfo(): AccountInfo\Customer
    {
        $customerInfo = new AccountInfo\Customer();
        $customerInfo->account_change = 20190814;
        $customerInfo->opening_account_date = 20190814;

        return $customerInfo;
    }

    /**
     * @return Purchase
     */
    private function purchaseInfo(): AccountInfo\Purchase
    {
        $purchaseInfo = new AccountInfo\Purchase();
        $purchaseInfo->count = 1;
        $purchaseInfo->card_stored_24h = 1;
        $purchaseInfo->payment_attempts_24h = 1;
        $purchaseInfo->payment_attempts_1y = 1;

        return $purchaseInfo;
    }

    /**
     * @return Payment
     */
    private function paymentInfo(): AccountInfo\Payment
    {
        $paymentInfo = new AccountInfo\Payment();
        $paymentInfo->enrollment_date = 20190814;

        return $paymentInfo;
    }

    /**
     * @return Shipping
     */
    private function shippingInfo(): AccountInfo\Shipping
    {
        $shippingInfo = new AccountInfo\Shipping();
        $shippingInfo->name_indicator = NameIndicator::IDENTICAL;

        return $shippingInfo;
    }

    /**
     * @return BrowserInfo
     */
    private function browserInfo(): BrowserInfo
    {
        $browserInfo = new BrowserInfo();
        $browserInfo->ipaddr = '127.0.0.1';
        $browserInfo->http_accept = $_SERVER['HTTP_ACCEPT'] ?? null;
        $browserInfo->javascript_enabled = true;
        $browserInfo->java_enabled = true;
        $browserInfo->language = 'fr';
        $browserInfo->color_depth = 32;
        $browserInfo->screen_height = 1900;
        $browserInfo->screen_width = 1280;
        $browserInfo->timezone = '-120';
        $browserInfo->http_user_agent = $_SERVER['HTTP_USER_AGENT'];

        return $browserInfo;
    }

    /**
     * @return PreviousAuthInfo
     */
    private function previousAuthInfo(): PreviousAuthInfo
    {
        $previousAuthInfo = new PreviousAuthInfo();
        $previousAuthInfo->transaction_reference = '';

        return $previousAuthInfo;
    }

    /**
     * @return MerchantRiskStatement
     */
    private function merchantRiskStatement(): MerchantRiskStatement
    {
        $merchantRiskStatement = new MerchantRiskStatement();
        $merchantRiskStatement->email_delivery_address = '';
        $merchantRiskStatement->delivery_time_frame = DeliveryTimeFrame::ELECTRONIC_DELIVERY;
        $merchantRiskStatement->purchase_indicator = PurchaseIndicator::MERCHANDISE_AVAILABLE;
        $merchantRiskStatement->reorder_indicator = ReorderIndicator::FIRST_TIME_ORDERED;
        $merchantRiskStatement->shipping_indicator = ShippingIndicator::DIGITAL_GOODS;

        return $merchantRiskStatement;
    }
}
