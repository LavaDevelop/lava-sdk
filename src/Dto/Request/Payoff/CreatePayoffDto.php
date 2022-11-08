<?php

namespace Lava\Api\Dto\Request\Payoff;

class CreatePayoffDto
{

    private string $orderId;
    private float $amount;
    private string $service;
    private ?string $walletTo;
    private ?string $hookUrl;
    private ?int $subtract;

    /**
     * @param string $orderId
     * @param float $amount
     * @param string $service
     * @param int|null $subtract
     * @param string|null $walletTo
     * @param string|null $hookUrl
     */
    public function __construct(string $orderId, float $amount, string $service, ?int $subtract = null, ?string $walletTo = null, ?string $hookUrl = null)
    {
        $this->orderId = $orderId;
        $this->amount = $amount;
        $this->service = $service;
        $this->walletTo = $walletTo;
        $this->hookUrl = $hookUrl;
        $this->subtract = $subtract;
    }

    /**
     * @return int|null
     */
    public function getSubtract(): ?int
    {
        return $this->subtract;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @return string|null
     */
    public function getWalletTo(): ?string
    {
        return $this->walletTo;
    }

    /**
     * @return string|null
     */
    public function getHookUrl(): ?string
    {
        return $this->hookUrl;
    }


}