<?php

namespace Lava\Api\Http\Client;

use JsonException;
use Lava\Api\Contracts\Client\ClientGenerateSignatureContract;

class ClientGenerateSignature implements ClientGenerateSignatureContract
{

    private string $secretKey;

    /**
     * @param string $secretKey
     */
    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @param array $data
     * @return string
     * @throws JsonException
     */
    public function generateSignature(array $data): string
    {
        ksort($data);

        return hash_hmac("sha256", json_encode($data, JSON_THROW_ON_ERROR), $this->secretKey);
    }

}