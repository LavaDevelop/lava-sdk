<?php

namespace Lava\Api\Contracts\Payoff;

use Lava\Api\Dto\Request\Payoff\CreatePayoffDto;
use Lava\Api\Dto\Response\Payoff\CreatedPayoffDto;

interface CreatePayoffContract
{

    /**
     * @param CreatePayoffDto $payoffDto
     * @param string $shopId
     * @return array
     */
    public function toArray(CreatePayoffDto $payoffDto, string $shopId): array;

    /**
     * @param array $response
     * @return CreatedPayoffDto
     */
    public function toDto(array $response): CreatedPayoffDto;

}