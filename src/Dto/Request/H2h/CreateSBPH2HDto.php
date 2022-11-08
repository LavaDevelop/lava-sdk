<?php

namespace Lava\Api\Dto\Request\H2h;

class CreateSBPH2HDto
{
    private float $amount;
    private string $orderId;
    private string $ip;
    private ?string $hookUrl;
    private ?string $customFields;
    private ?string $comment;
    private ?string $successUrl;
    private ?string $failUrl;
    private ?int $expire;

    /**
     * @param float $amount
     * @param string $orderId
     * @param string $ip
     * @param string|null $hookUrl
     * @param string|null $customFields
     * @param string|null $comment
     * @param string|null $successUrl
     * @param string|null $failUrl
     * @param int|null $expire
     */
    public function __construct(float $amount, string $orderId, string $ip, ?string $hookUrl = null, ?string $customFields = null, ?string $comment = null, ?string $successUrl = null, ?string $failUrl = null, ?int $expire = 300)
    {
        $this->amount = $amount;
        $this->orderId = $orderId;
        $this->ip = $ip;
        $this->hookUrl = $hookUrl;
        $this->customFields = $customFields;
        $this->comment = $comment;
        $this->successUrl = $successUrl;
        $this->failUrl = $failUrl;
        $this->expire = $expire;
    }

    /**
     * @return int|null
     */
    public function getExpire(): ?int
    {
        return $this->expire;
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
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return string|null
     */
    public function getHookUrl(): ?string
    {
        return $this->hookUrl;
    }

    /**
     * @return string|null
     */
    public function getCustomFields(): ?string
    {
        return $this->customFields;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @return string|null
     */
    public function getSuccessUrl(): ?string
    {
        return $this->successUrl;
    }

    /**
     * @return string|null
     */
    public function getFailUrl(): ?string
    {
        return $this->failUrl;
    }

}