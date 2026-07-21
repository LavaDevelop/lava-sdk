<?php

namespace Lava\Api\Dto\Request\Recurrent;

class CreateSubscriptionDto
{
    private string $productId;
    private string $consumerId;
    private string $orderId;

    public function __construct(string $productId, string $consumerId, string $orderId)
    {
        $this->productId = $productId;
        $this->consumerId = $consumerId;
        $this->orderId = $orderId;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getConsumerId(): string
    {
        return $this->consumerId;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }
}
