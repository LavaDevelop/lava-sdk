<?php

namespace Lava\Api\Dto\Response\Invoice;

use Lava\Api\Exceptions\BaseException;

class CreatedInvoiceDto
{

    private string $invoiceId;
    private float $amount;
    private string $expired;
    private int $status;
    private string $shopId;
    private string $url;

    /**
     * @param string $invoiceId
     * @param float $amount
     * @param string $expired
     * @param int $status
     * @param string $shopId
     * @param string $url
     */
    public function __construct(string $invoiceId, float $amount, string $expired, int $status, string $shopId, string $url)
    {
        $this->invoiceId = $invoiceId;
        $this->amount = $amount;
        $this->expired = $expired;
        $this->status = $status;
        $this->shopId = $shopId;
        $this->url = $url;
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
     * @return string
     */
    public function getInvoiceId(): string
    {
        return $this->invoiceId;
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
    public function getExpired(): string
    {
        return $this->expired;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getShopId(): string
    {
        return $this->shopId;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

}