<?php

namespace Lava\Api\Dto\Response\Course;

class CurrencyDto
{
    public string $label;
    public string $symbol;
    public string $value;

    public function __construct(string $label, string $symbol, string $value)
    {
        $this->label = $label;
        $this->symbol = $symbol;
        $this->value = $value;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}