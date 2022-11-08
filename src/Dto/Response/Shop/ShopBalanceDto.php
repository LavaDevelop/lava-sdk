<?php

namespace Lava\Api\Dto\Response\Shop;

use Lava\Api\Exceptions\BaseException;

class ShopBalanceDto
{

    private float $balance;
    private float $freezeBalance;


    public function __construct(float $balance, float $freezeBalance)
    {
        $this->balance = $balance;
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
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return float
     */
    public function getFreezeBalance(): float
    {
        return $this->freezeBalance;
    }
}