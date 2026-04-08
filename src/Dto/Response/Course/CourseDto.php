<?php

namespace Lava\Api\Dto\Response\Course;

class CourseDto
{
    private CurrencyDto $currency;
    private float $value;

    public function __construct(CurrencyDto $currency, float $value)
    {
        $this->currency = $currency;
        $this->value = $value;
    }

    public function getCurrency(): CurrencyDto
    {
        return $this->currency;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}