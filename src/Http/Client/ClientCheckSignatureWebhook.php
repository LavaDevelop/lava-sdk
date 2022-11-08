<?php

namespace Lava\Api\Http\Client;

use JsonException;
use Lava\Api\Contracts\Client\ClientCheckSignatureWebhookContract;

class ClientCheckSignatureWebhook implements ClientCheckSignatureWebhookContract
{

    private ?string $secretKey;

    /**
     * @param string|null $secretKey
     */
    public function __construct(?string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @param string $webhookResponse
     * @param string $signature
     * @return bool
     * @throws JsonException
     */
    public function checkSignWebhook(string $webhookResponse, string $signature): bool
    {
        $data = json_decode($webhookResponse, true, 512, JSON_THROW_ON_ERROR);

        ksort($data);
        $hookSignature = hash_hmac("sha256", json_encode($data), $this->secretKey);

        return $hookSignature === $signature;
    }

}