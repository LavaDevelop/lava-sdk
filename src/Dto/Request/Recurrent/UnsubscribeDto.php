<?php

namespace Lava\Api\Dto\Request\Recurrent;

class UnsubscribeDto
{
    private ?string $subscriptionId;
    private ?string $orderId;

    public function __construct(?string $subscriptionId = null, ?string $orderId = null)
    {
        $this->subscriptionId = $subscriptionId;
        $this->orderId = $orderId;
    }

    public function getSubscriptionId(): ?string
    {
        return $this->subscriptionId;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }
}
