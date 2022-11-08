<?php

namespace Lava\Api\Contracts\Client;

interface ClientCheckSignatureWebhookContract
{

    /**
     * @param string $webhookResponse
     * @param string $signature
     * @return bool
     */
    public function checkSignWebhook(string $webhookResponse, string $signature): bool;

}