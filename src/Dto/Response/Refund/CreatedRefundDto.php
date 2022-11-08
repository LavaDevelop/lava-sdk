<?php

namespace Lava\Api\Dto\Response\Refund;

use Lava\Api\Exceptions\BaseException;

class CreatedRefundDto
{

    private string $status;
    private string $refundId;
    private float $amount;
    private string $service;
    private string $label;

    /**
     * @param string $status
     * @param string $refundId
     * @param float $amount
     * @param string $service
     * @param string $label
     */
    public function __construct(string $status, string $refundId, float $amount, string $service, string $label)
    {
        $this->status = $status;
        $this->refundId = $refundId;
        $this->amount = $amount;
        $this->service = $service;
        $this->label = $label;
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
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getRefundId(): string
    {
        return $this->refundId;
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
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

}