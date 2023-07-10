<?php

namespace Lava\Api\Contracts\Payoff;

use Lava\Api\Dto\Response\Payoff\TariffResponseDto;

interface TariffContract
{

    /**
     * @param array $response
     * @return array<TariffResponseDto>
     */
    public function toDto(array $response): array;

}