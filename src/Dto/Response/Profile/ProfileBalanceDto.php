<?php

namespace Lava\Api\Dto\Response\Profile;

use Lava\Api\Exceptions\BaseException;

class ProfileBalanceDto
{
    /**
     * The profile balance consists of the sum of the available balance and the frozen balance
     * @var float
     */
    private float $totalBalance;

    /**
     * Available balance is funds that can be withdrawn
     * @var float
     */
    private float $availableBalance;

    /**
     * Frozen balance is funds that currently cannot be withdrawn
     * @var float
     */
    private float $freezeBalance;

    public function __construct(float $totalBalance, float $availableBalance, float $freezeBalance)
    {
        $this->totalBalance = $totalBalance;
        $this->availableBalance = $availableBalance;
        $this->freezeBalance = $freezeBalance;
    }

    /**
     * @param $name
     * @return mixed
     * @throws BaseException
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new BaseException('Property not found');
    }

    /**
     * @return float
     */
    public function getTotalBalance(): float
    {
        return $this->totalBalance;
    }

    /**
     * @return float
     */
    public function getAvailableBalance(): float
    {
        return $this->availableBalance;
    }

    /**
     * @return float
     */
    public function getFreezeBalance(): float
    {
        return $this->freezeBalance;
    }
}