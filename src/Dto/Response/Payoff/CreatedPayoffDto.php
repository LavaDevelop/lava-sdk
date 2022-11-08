<?php

namespace Lava\Api\Dto\Response\Payoff;

use Lava\Api\Exceptions\BaseException;

class CreatedPayoffDto
{

    private string $payoffId;
    private string $status;

    /**
     * @param string $payoffId
     * @param string $status
     */
    public function __construct(string $payoffId, string $status)
    {
        $this->payoffId = $payoffId;
        $this->status = $status;
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
     * @return string
     */
    public function getPayoffId(): string
    {
        return $this->payoffId;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}