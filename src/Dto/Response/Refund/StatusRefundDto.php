<?php

namespace Lava\Api\Dto\Response\Refund;

use Lava\Api\Exceptions\BaseException;

class StatusRefundDto
{

    private string $status;
    private string $refundId;
    private float $amount;

    /**
     * @param string $status
     * @param string $refundId
     * @param float $amount
     */
    public function __construct(string $status, string $refundId, float $amount)
    {
        $this->status = $status;
        $this->refundId = $refundId;
        $this->amount = $amount;
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

}