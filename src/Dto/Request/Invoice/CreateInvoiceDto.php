<?php

namespace Lava\Api\Dto\Request\Invoice;


class CreateInvoiceDto
{

    private string $sum;
    private string $orderId;
    private ?string $hookUrl;
    private ?string $successUrl;
    private ?string $failUrl;
    private ?int $expire;
    private ?string $customFields;
    private ?string $comment;
    private ?array $includeService;
    private ?array $excludeService;

    /**
     * @param string $sum
     * @param string $orderId
     * @param string|null $hookUrl
     * @param string|null $successUrl
     * @param string|null $failUrl
     * @param int|null $expire
     * @param string|null $customFields
     * @param string|null $comment
     * @param array|null $excludeService
     * @param array|null $includeService
     */
    public function __construct(string $sum, string $orderId, ?string $hookUrl = null, ?string $successUrl = null, ?string $failUrl = null, ?int $expire = null, ?string $customFields = null, ?string $comment = null, ?array $excludeService = null, ?array $includeService = null)
    {
        $this->sum = $sum;
        $this->orderId = $orderId;
        $this->hookUrl = $hookUrl;
        $this->successUrl = $successUrl;
        $this->failUrl = $failUrl;
        $this->expire = $expire;
        $this->customFields = $customFields;
        $this->comment = $comment;
        $this->excludeService = $excludeService;
        $this->includeService = $includeService;
    }

    /**
     * @return string
     */
    public function getSum(): string
    {
        return $this->sum;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
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

    /**
     * @return int|null
     */
    public function getExpire(): ?int
    {
        return $this->expire;
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
     * @return array|null
     */
    public function getIncludeService(): ?array
    {
        return $this->includeService;
    }

    /**
     * @return array|null
     */
    public function getExcludeService(): ?array
    {
        return $this->excludeService;
    }

}