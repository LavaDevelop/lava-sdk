<?php

namespace Lava\Api\Dto\Response\Recurrent;

class ProductDto
{
    private string $id;
    private string $name;
    private float $price;
    private string $period;
    private int $periodDays;
    private int $freeDays;
    private ?string $description;
    private string $shopId;
    private bool $isActive;
    private int $activeCount;
    private int $inactiveCount;
    private int $subscribersCount;

    public function __construct(array $product)
    {
        $this->id = $product['id'];
        $this->name = $product['name'];
        $this->price = (float)$product['price'];
        $this->period = $product['period'];
        $this->periodDays = (int)$product['periodDays'];
        $this->freeDays = (int)$product['freeDays'];
        $this->description = $product['description'] ?? null;
        $this->shopId = $product['shopId'];
        $this->isActive = (bool)$product['isActive'];
        $this->activeCount = (int)$product['activeCount'];
        $this->inactiveCount = (int)$product['inactiveCount'];
        $this->subscribersCount = (int)$product['subscribersCount'];
    }

    public function getId(): string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getPrice(): float { return $this->price; }
    public function getPeriod(): string { return $this->period; }
    public function getPeriodDays(): int { return $this->periodDays; }
    public function getFreeDays(): int { return $this->freeDays; }
    public function getDescription(): ?string { return $this->description; }
    public function getShopId(): string { return $this->shopId; }
    public function isActive(): bool { return $this->isActive; }
    public function getActiveCount(): int { return $this->activeCount; }
    public function getInactiveCount(): int { return $this->inactiveCount; }
    public function getSubscribersCount(): int { return $this->subscribersCount; }
}
