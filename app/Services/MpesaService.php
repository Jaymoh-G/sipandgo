<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MpesaService
{
    protected string $consumerKey;
    protected string $consumerSecret;
    protected string $shortcode;
    protected string $passkey;
    protected string $callbackUrl;
    protected string $accountReference;
    protected string $transactionDesc;
    protected string $environment;

    public function __construct()
    {
        $config = config('services.mpesa');

        $this->consumerKey = $config['consumer_key'] ?? '';
        $this->consumerSecret = $config['consumer_secret'] ?? '';
        $this->shortcode = $config['shortcode'] ?? '';
        $this->passkey = $config['passkey'] ?? '';
        $this->callbackUrl = $config['callback_url'] ?? '';
        $this->accountReference = $config['account_reference'] ?? 'SIPANDGO';
        $this->transactionDesc = $config['transaction_desc'] ?? 'Sip & Go Order';
        $this->environment = $config['env'] ?? 'sandbox';
    }

    /**
     * Initiate an STK Push request to Safaricom Daraja API.
     */
    public function stkPush(string $phoneNumber, float $amount, string $reference, ?string $remarks = null): array
    {
        $this->ensureConfigured();

        $accessToken = $this->getAccessToken();
        $endpoint = $this->baseUrl() . '/mpesa/stkpush/v1/processrequest';

        $timestamp = now()->format('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        $payload = [
            'BusinessShortCode' => $this->shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => (int) round($amount),
            'PartyA' => $phoneNumber,
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $phoneNumber,
            'CallBackURL' => $this->callbackUrl,
            'AccountReference' => $reference ?: $this->accountReference,
            'TransactionDesc' => $remarks ?: $this->transactionDesc,
        ];

        $response = Http::withToken($accessToken)->post($endpoint, $payload);

        if ($response->successful() && ($response['ResponseCode'] ?? null) === '0') {
            return [
                'success' => true,
                'checkout_request_id' => $response['CheckoutRequestID'] ?? null,
                'merchant_request_id' => $response['MerchantRequestID'] ?? null,
                'customer_message' => $response['CustomerMessage'] ?? 'STK push sent successfully.',
            ];
        }

        Log::error('MPESA STK Push failed', [
            'response' => $response->json(),
        ]);

        return [
            'success' => false,
            'message' => $response['errorMessage'] ?? 'Failed to initiate STK push.',
        ];
    }

    protected function getAccessToken(): string
    {
        $endpoint = $this->baseUrl() . '/oauth/v1/generate?grant_type=client_credentials';

        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)->get($endpoint);

        if (!$response->successful()) {
            Log::error('MPESA access token request failed', ['response' => $response->json()]);
            throw new \RuntimeException('Unable to authenticate with MPESA API.');
        }

        return $response['access_token'];
    }

    protected function baseUrl(): string
    {
        return $this->environment === 'production'
            ? 'https://api.safaricom.co.ke'
            : 'https://sandbox.safaricom.co.ke';
    }

    protected function ensureConfigured(): void
    {
        if (
            empty($this->consumerKey) ||
            empty($this->consumerSecret) ||
            empty($this->shortcode) ||
            empty($this->passkey) ||
            empty($this->callbackUrl)
        ) {
            throw new \RuntimeException('MPESA credentials are not fully configured.');
        }
    }
}

