<?php

namespace App\Services;

use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\CheckoutFormInitialize;
use Iyzipay\Model\CheckoutForm;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Options;
use Iyzipay\Model\AmountBaseRefund;
use Iyzipay\Request\AmountBaseRefundRequest;
use Iyzipay\Request\CreateCheckoutFormInitializeRequest;
use Iyzipay\Request\RetrieveCheckoutFormRequest;

class IyzicoService
{
    private Options $options;

    public function __construct()
    {
        $this->options = new Options();
        $this->options->setApiKey(\App\Models\Setting::get('iyzico_api_key') ?: config('services.iyzico.api_key'));
        $this->options->setSecretKey(\App\Models\Setting::get('iyzico_secret_key') ?: config('services.iyzico.secret_key'));
        $this->options->setBaseUrl(\App\Models\Setting::get('iyzico_base_url') ?: config('services.iyzico.base_url'));
    }

    public function initializeCheckout(array $orderData): array
    {
        $request = new CreateCheckoutFormInitializeRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId($orderData['order_number']);
        $total = $orderData['subtotal'] + ($orderData['delivery_fee'] ?? 0);
        $request->setPrice(number_format($total, 2, '.', ''));
        $request->setPaidPrice(number_format($total, 2, '.', ''));
        $request->setCurrency(Currency::TL);
        $request->setBasketId($orderData['order_number']);
        $request->setPaymentGroup(PaymentGroup::PRODUCT);
        $request->setCallbackUrl($orderData['callback_url']);
        $request->setEnabledInstallments([1]); // Sadece tek çekim (taksit yok)

        $buyer = new Buyer();
        $buyer->setId((string) $orderData['user_id']);
        $nameParts = preg_split('/\s+/', trim($orderData['customer_name'] ?? ''), 2);
        $buyer->setName($nameParts[0] ?: 'Müşteri');
        $buyer->setSurname($nameParts[1] ?? '-');
        $buyer->setGsmNumber($orderData['phone']);
        $buyer->setEmail($orderData['email']);
        $buyer->setIdentityNumber('11111111111');
        $buyer->setLastLoginDate(now()->format('Y-m-d H:i:s'));
        $buyer->setRegistrationDate(now()->subYear()->format('Y-m-d H:i:s'));
        $buyer->setRegistrationAddress($orderData['address']);
        $buyer->setIp(request()->ip());
        $buyer->setCity($orderData['city_name']);
        $buyer->setCountry('Turkey');
        $buyer->setZipCode('34000');
        $request->setBuyer($buyer);

        $address = new Address();
        $address->setContactName($orderData['customer_name']);
        $address->setCity($orderData['city_name']);
        $address->setCountry('Turkey');
        $address->setAddress($orderData['address']);
        $address->setZipCode('34000');
        $request->setShippingAddress($address);
        $request->setBillingAddress($address);

        $basketItems = [];
        foreach ($orderData['items'] as $index => $item) {
            $basketItem = new BasketItem();
            $basketItem->setId('BI' . ($index + 1));
            $basketItem->setName($item['name']);
            $basketItem->setCategory1('Yemek');
            $basketItem->setCategory2('İçecek');
            $basketItem->setItemType(BasketItemType::PHYSICAL);
            $lineTotal = $item['price'] * $item['quantity'];
        $basketItem->setPrice(number_format($lineTotal, 2, '.', ''));
            $basketItems[] = $basketItem;
        }

        if (!empty($orderData['delivery_fee']) && $orderData['delivery_fee'] > 0) {
            $basketItem = new BasketItem();
            $basketItem->setId('BI999');
            $basketItem->setName('Kurye Ücreti');
            $basketItem->setCategory1('Teslimat');
            $basketItem->setCategory2('Kurye');
            $basketItem->setItemType(BasketItemType::VIRTUAL);
            $basketItem->setPrice(number_format($orderData['delivery_fee'], 2, '.', ''));
            $basketItems[] = $basketItem;
        }

        $request->setBasketItems($basketItems);

        $result = CheckoutFormInitialize::create($request, $this->options);

        return [
            'status' => $result->getStatus(),
            'token' => $result->getToken(),
            'checkout_form_content' => $result->getCheckoutFormContent(),
            'payment_page_url' => $result->getPaymentPageUrl(),
            'error_message' => $result->getErrorMessage(),
            'error_code' => $result->getErrorCode(),
        ];
    }

    public function retrieveCheckoutForm(string $token, string $conversationId = ''): array
    {
        $request = new RetrieveCheckoutFormRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId($conversationId);
        $request->setToken($token);

        $result = CheckoutForm::retrieve($request, $this->options);

        return [
            'status' => $result->getStatus(),
            'payment_status' => $result->getPaymentStatus(),
            'payment_id' => $result->getPaymentId(),
            'basket_id' => $result->getBasketId(),
            'paid_price' => $result->getPaidPrice(),
            'error_message' => $result->getErrorMessage(),
        ];
    }

    /**
     * İyzico üzerinden iade oluşturur (Checkout Form ödemeleri için AmountBaseRefund).
     *
     * @param string $paymentId İyzico payment id
     * @param float $amount İade tutarı (TL)
     * @param string $conversationId Sipariş numarası veya benzersiz id
     * @return array ['success' => bool, 'status' => string, 'error_message' => string|null]
     */
    public function refund(string $paymentId, float $amount, string $conversationId = ''): array
    {
        $request = new AmountBaseRefundRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId($conversationId ?: uniqid('refund-'));
        $request->setPaymentId($paymentId);
        $request->setPrice(round($amount, 2));
        $request->setIp(request()->ip() ?: '127.0.0.1');

        $result = AmountBaseRefund::create($request, $this->options);

        return [
            'success' => $result->getStatus() === 'success',
            'status' => $result->getStatus(),
            'error_message' => $result->getErrorMessage(),
        ];
    }
}
