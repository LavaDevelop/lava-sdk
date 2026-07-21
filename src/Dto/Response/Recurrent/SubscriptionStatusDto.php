<?php

namespace Lava\Api\Dto\Response\Recurrent;

class SubscriptionStatusDto
{
    private string $subscriptionId;
    private string $orderId;
    private string $consumerId;
    private string $shopId;
    private string $productId;
    private string $status;
    private float $amount;
    private ?string $activationTime;
    private ?string $lastPayTime;
    private ?string $nextPayTime;
    private ?string $deactivationTime;
    private ?string $deactivatedReason;
    private ?string $payerDetails;

    public function __construct(array $subscription)
    {
        $this->subscriptionId = $subscription['subscriptionId'];
        $this->orderId = $subscription['orderId'];
        $this->consumerId = $subscription['consumerId'];
        $this->shopId = $subscription['shopId'];
        $this->productId = $subscription['productId'];
        $this->status = $subscription['status'];
        $this->amount = (float)$subscription['amount'];
        $this->activationTime = $subscription['activation_time'] ?? null;
        $this->lastPayTime = $subscription['last_pay_time'] ?? null;
        $this->nextPayTime = $subscription['next_pay_time'] ?? null;
        $this->deactivationTime = $subscription['deactivation_time'] ?? null;
        $this->deactivatedReason = $subscription['deactivated_reason'] ?? null;
        $this->payerDetails = $subscription['payer_details'] ?? null;
    }

    public function getSubscriptionId(): string { return $this->subscriptionId; }
    public function getOrderId(): string { return $this->orderId; }
    public function getConsumerId(): string { return $this->consumerId; }
    public function getShopId(): string { return $this->shopId; }
    public function getProductId(): string { return $this->productId; }
    public function getStatus(): string { return $this->status; }
    public function getAmount(): float { return $this->amount; }
    public function getActivationTime(): ?string { return $this->activationTime; }
    public function getLastPayTime(): ?string { return $this->lastPayTime; }
    public function getNextPayTime(): ?string { return $this->nextPayTime; }
    public function getDeactivationTime(): ?string { return $this->deactivationTime; }
    public function getDeactivatedReason(): ?string { return $this->deactivatedReason; }
    public function getPayerDetails(): ?string { return $this->payerDetails; }
}
