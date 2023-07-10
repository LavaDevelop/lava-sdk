<?php

namespace Lava\Api\Dto\Response\Payoff;

class TariffResponseDto
{

    /**
     * @var float
     */
    public float $percent;
    /**
     * @var float|null
     */
    public ?float $minSum;
    /**
     * @var float|null
     */
    public ?float $maxSum;
    /**
     * @var string
     */
    public string $service;
    /**
     * @var float|null
     */
    public ?float $fix;
    /**
     * @var string|null
     */
    public ?string $title;
    /**
     * @var string
     */
    public string $currency;

    public function __construct(?float $percent, ?float $maxSum, string $service, ?float $fix, ?string $title, string $currency, ?float $minSum)
    {
        $this->currency = $currency;
        $this->percent = $percent;
        $this->fix = $fix;
        $this->title = $title;
        $this->service = $service;
        $this->maxSum = $maxSum;
        $this->minSum = $minSum;
    }

    /**
     * @return float
     */
    public function getPercent(): float
    {
        return $this->percent;
    }

    /**
     * @param float $percent
     */
    public function setPercent(float $percent): void
    {
        $this->percent = $percent;
    }

    /**
     * @return float|null
     */
    public function getMinSum(): ?float
    {
        return $this->minSum;
    }

    /**
     * @param float|null $minSum
     */
    public function setMinSum(?float $minSum): void
    {
        $this->minSum = $minSum;
    }

    /**
     * @return float|null
     */
    public function getMaxSum(): ?float
    {
        return $this->maxSum;
    }

    /**
     * @param float|null $maxSum
     */
    public function setMaxSum(?float $maxSum): void
    {
        $this->maxSum = $maxSum;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @param string $service
     */
    public function setService(string $service): void
    {
        $this->service = $service;
    }

    /**
     * @return float|null
     */
    public function getFix(): ?float
    {
        return $this->fix;
    }

    /**
     * @param float|null $fix
     */
    public function setFix(?float $fix): void
    {
        $this->fix = $fix;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }


}
