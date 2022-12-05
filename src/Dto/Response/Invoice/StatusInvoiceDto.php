<?php

namespace Lava\Api\Dto\Response\Invoice;


use Lava\Api\Exceptions\BaseException;

class StatusInvoiceDto
{

    private string $status;
    private ?string $errorMessage;
    private string $invoiceId;
    private string $shopId;
    private float $amount;
    private string $expire;
    private string $orderId;
    private ?string $failUrl;
    private ?string $successUrl;
    private ?string $hookUrl;
    private ?string $customFields;
    private ?array $excludeService;
    private ?array $includeService;

    /**
     * @param string $status
     * @param string|null $errorMessage
     * @param string $invoiceId
     * @param string $shopId
     * @param float $amount
     * @param string $expire
     * @param string $orderId
     * @param string|null $failUrl
     * @param string|null $successUrl
     * @param string|null $hookUrl
     * @param string|null $customFields
     * @param array|null $includeService
     * @param array|null $excludeService
     */
    public function __construct(string $status, ?string $errorMessage, string $invoiceId, string $shopId, float $amount, string $expire, string $orderId, ?string $failUrl, ?string $successUrl, ?string $hookUrl, ?string $customFields, ?array $includeService, ?array $excludeService)
    {
        $this->status = $status;
        $this->errorMessage = $errorMessage;
        $this->invoiceId = $invoiceId;
        $this->shopId = $shopId;
        $this->amount = $amount;
        $this->expire = $expire;
        $this->orderId = $orderId;
        $this->failUrl = $failUrl;
        $this->successUrl = $successUrl;
        $this->hookUrl = $hookUrl;
        $this->customFields = $customFields;
        $this->excludeService = $excludeService;
        $this->includeService = $includeService;
    }

    /**
     * @param $name
     * @return mixed
     * @throws BaseException
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new BaseException('Property not found');
    }

    /**
     * @return array|null
     */
    public function getExcludeService(): ?array
    {
        return $this->excludeService;
    }

    /**
     * @return array|null
     */
    public function getIncludeService(): ?array
    {
        return $this->includeService;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @return string
     */
    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    /**
     * @return string
     */
    public function getShopId(): string
    {
        return $this->shopId;
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
    public function getExpire(): string
    {
        return $this->expire;
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
    public function getFailUrl(): ?string
    {
        return $this->failUrl;
    }

    /**
     * @return string
     */
    public function getSuccessUrl(): ?string
    {
        return $this->successUrl;
    }

    /**
     * @return string
     */
    public function getHookUrl(): ?string
    {
        return $this->hookUrl;
    }

    /**
     * @return string
     */
    public function getCustomFields(): ?string
    {
        return $this->customFields;
    }

}