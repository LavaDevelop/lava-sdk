<?php

namespace Lava\Api\Dto\Request\Recurrent;

class OffsetNextPayTimeDto
{
    private int $days;
    private ?string $subscriptionId;
    private ?string $orderId;

    public function __construct(int $days, ?string $subscriptionId = null, ?string $orderId = null)
    {
        $this->days = $days;
        $this->subscriptionId = $subscriptionId;
        $this->orderId = $orderId;
    }

    public function getDays(): int
    {
        return $this->days;
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
