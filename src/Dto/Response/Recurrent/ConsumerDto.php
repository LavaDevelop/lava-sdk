<?php

namespace Lava\Api\Dto\Response\Recurrent;

class ConsumerDto
{
    private ?string $phone;
    private string $email;
    private string $consumerId;
    private string $shopId;

    public function __construct(array $consumer)
    {
        $this->phone = $consumer['phone'] ?? null;
        $this->email = $consumer['email'];
        $this->consumerId = $consumer['consumerId'];
        $this->shopId = $consumer['shopId'];
    }

    public function getPhone(): ?string { return $this->phone; }
    public function getEmail(): string { return $this->email; }
    public function getConsumerId(): string { return $this->consumerId; }
    public function getShopId(): string { return $this->shopId; }
}
