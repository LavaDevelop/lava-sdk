<?php

namespace Lava\Api\Dto\Response\H2h;

use Lava\Api\Exceptions\BaseException;

class CreatedH2hInvoiceDto
{
    
    private string $url;
    private string $invoiceId;
    private string $cardMask;
    private float $amount;
    private float $amountPay;
    private float $commission;
    private string $shopId;

    /**
     * @param string $url
     * @param string $invoiceId
     * @param string $cardMask
     * @param float $amount
     * @param float $amountPay
     * @param float $commission
     * @param string $shopId
     */
    public function __construct(string $url, string $invoiceId, string $cardMask, float $amount, float $amountPay, float $commission, string $shopId)
    {
        $this->url = $url;
        $this->invoiceId = $invoiceId;
        $this->cardMask = $cardMask;
        $this->amount = $amount;
        $this->amountPay = $amountPay;
        $this->commission = $commission;
        $this->shopId = $shopId;
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
    public function getUrl(): string
    {
        return $this->url;
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
    public function getCardMask(): string
    {
        return $this->cardMask;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getAmountPay(): float
    {
        return $this->amountPay;
    }

    /**
     * @return float
     */
    public function getCommission(): float
    {
        return $this->commission;
    }

    /**
     * @return string
     */
    public function getShopId(): string
    {
        return $this->shopId;
    }
}