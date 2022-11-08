<?php

namespace Lava\Api\Dto\Response\Payoff;

use Lava\Api\Exceptions\BaseException;

class StatusPayoffDto
{

    private string $id;
    private string $orderId;
    private string $status;
    private string $service;
    private float $amountPay;
    private float $commission;
    private float $amountReceive;
    private int $tryCount;
    private ?string $wallet;
    private ?string $errorMessage;

    /**
     * @param string $id
     * @param string $orderId
     * @param string $status
     * @param string|null $wallet
     * @param string $service
     * @param float $amountPay
     * @param float $commission
     * @param float $amountReceive
     * @param int $tryCount
     * @param string|null $errorMessage
     */
    public function __construct(string $id, string $orderId, string $status, ?string $wallet, string $service, float $amountPay, float $commission, float $amountReceive, int $tryCount, ?string $errorMessage)
    {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->status = $status;
        $this->wallet = $wallet;
        $this->service = $service;
        $this->amountPay = $amountPay;
        $this->amountReceive = $amountReceive;
        $this->tryCount = $tryCount;
        $this->errorMessage = $errorMessage;
        $this->commission = $commission;
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
    public function getId(): string
    {
        return $this->id;
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
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
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
     * @return float
     */
    public function getAmountReceive(): float
    {
        return $this->amountReceive;
    }

    /**
     * @return int
     */
    public function getTryCount(): int
    {
        return $this->tryCount;
    }

    /**
     * @return string|null
     */
    public function getWallet(): ?string
    {
        return $this->wallet;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

}