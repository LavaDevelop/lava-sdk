<?php

namespace Lava\Api\Dto\Response\Invoice;

class AvailibleTariffDto
{


    /**
     * @var float
     */
    private float $percent;
    /**
     * @var float
     */
    private float $userPercent;


    /**
     * @var float
     */
    private float $shopPercent;
    /**
     * @var string
     */
    private string $serviceName;
    /**
     * @var string
     */
    private string $serviceId;
    /**
     * @var int
     */
    private int $status;
    /**
     * @var string
     */
    private string $currency;

    /**
     * @param int $status
     * @param float $percent
     * @param float $userPercent
     * @param float $shopPercent
     * @param string $serviceName
     * @param string $serviceId
     * @param string $currency
     */
    public function __construct(
        int    $status,
        float  $percent,
        float  $userPercent,
        float  $shopPercent,
        string $serviceName,
        string $serviceId,
        string $currency
    )
    {
        $this->status = $status;
        $this->serviceId = $serviceId;
        $this->percent = $percent;
        $this->userPercent = $userPercent;
        $this->serviceName = $serviceName;
        $this->currency = $currency;
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
     *
     * @return void
     */
    public function setPercent(float $percent): void
    {
        $this->percent = $percent;
    }

    /**
     * @return float
     */
    public function getUserPercent(): float
    {
        return $this->userPercent;
    }

    /**
     * @param float $userPercent
     *
     * @return void
     */
    public function setUserPercent(float $userPercent): void
    {
        $this->userPercent = $userPercent;
    }

    /**
     * @return string
     */
    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    /**
     * @param string $serviceName
     *
     * @return void
     */
    public function setServiceName(string $serviceName): void
    {
        $this->serviceName = $serviceName;
    }

    /**
     * @return string
     */
    public function getServiceId(): string
    {
        return $this->serviceId;
    }

    /**
     * @param string $serviceId
     *
     * @return void
     */
    public function setServiceId(string $serviceId): void
    {
        $this->serviceId = $serviceId;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return void
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
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
     * @return void
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }


    /**
     * @return float
     */
    public function getShopPercent(): float
    {
        return $this->shopPercent;
    }

    /**
     * @param float $shopPercent
     * @return void
     */
    public function setShopPercent(float $shopPercent): void
    {
        $this->shopPercent = $shopPercent;
    }
}