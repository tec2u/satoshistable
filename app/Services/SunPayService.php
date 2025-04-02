<?php

namespace App\Services;

use GuzzleHttp\Client;

class SunPayService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://sandbox-oapi.klicklpay.com/api/v3']);
        $this->apiKey = env('SUNPAY_API_KEY');
    }

    public function createPayment($paymentData)
    {
        $currency_code = "USD";
        $secret_key = $this->apiKey;
        $timestamp = intval(microtime(true) * 1000);

        $nonce = bin2hex(random_bytes(16));

        $body = [
            'out_order_no' => $paymentData['order_id'] . '-' . rand(10, 9999),
            'out_user_id'  => $paymentData['user_id'],
            'amount' => $paymentData['amount'] * $paymentData['price'],
            'currency' => $currency_code,
            'payment_type' => 'BANK',
            'name' => $paymentData['name'],
            'redirect_url' => route('packages.packagelog'),
            'cancel_url' => route('packages.packagelog'),
            'webhook_url' => route('notify_sunvolt')
        ];

        // Certifique-se de que o JSON esteja formatado corretamente sem espaços extras
        $bodyJson = json_encode($body, JSON_UNESCAPED_SLASHES);

        // Criando a string de payload corretamente
        $payload = $timestamp . $nonce . $bodyJson;

        // Gerando a assinatura usando HMAC-SHA256
        $signature = hash_hmac('sha256', $payload, $secret_key, true);
        $final_signature = strtoupper(bin2hex($signature));

        try {
            $response = $this->client->withoutVerifying()->post('/Fiat/PayIn', [
                'headers' => [
                    "Content-Type" => "application/json;charset=UTF-8",
                    "SunPay-Key" => $this->apiKey, // Defina a chave da API corretamente
                    "SunPay-Timestamp" => $timestamp,
                    "SunPay-Nonce" => $nonce,
                    "SunPay-Sign" => $final_signature
                ],
                'json' => $body,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}
