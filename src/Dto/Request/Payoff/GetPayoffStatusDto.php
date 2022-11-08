<?php

namespace Lava\Api\Dto\Request\Payoff;

class GetPayoffStatusDto
{

    private ?string $orderId;
    private ?string $payoffId;

    /**
     * @param string|null $orderId
     * @param string|null $payoffId
     */
    public function __construct(?string $orderId = null, ?string $payoffId = null)
    {
        $this->orderId = $orderId;
        $this->payoffId = $payoffId;
    }

    /**
     * @return string|null
     */
    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    /**
     * @return string|null
     */
    public function getPayoffId(): ?string
    {
        return $this->payoffId;
    }

}