<?php

namespace Lava\Api\Dto\Response\Recurrent;

class CreatedSubscriptionDto
{
    private string $subscriptionId;
    private float $amount;
    private string $expired;
    private string $url;
    private ?string $comment;

    public function __construct(array $subscription)
    {
        $this->subscriptionId = $subscription['subscriptionId'];
        $this->amount = (float)$subscription['amount'];
        $this->expired = $subscription['expired'];
        $this->url = $subscription['url'];
        $this->comment = $subscription['comment'] ?? null;
    }

    public function getSubscriptionId(): string { return $this->subscriptionId; }
    public function getAmount(): float { return $this->amount; }
    public function getExpired(): string { return $this->expired; }
    public function getUrl(): string { return $this->url; }
    public function getComment(): ?string { return $this->comment; }
}
