<?php

namespace Lava\Api\Http\Payoffs;

use Lava\Api\Contracts\Payoff\TariffContract;
use Lava\Api\Dto\Response\Payoff\TariffResponseDto;

class TariffDto implements TariffContract
{
    /**
     * @param array $response
     * @return array<TariffResponseDto>
     */
    public function toDto(array $response): array
    {
        $tariffs = [];

        foreach ($response['data']['tariffs'] as $tariff) {
            $tariffs[] = new TariffResponseDto(
                $tariff['percent'],
                $tariff['max_sum'],
                $tariff['service'],
                $tariff['fix'],
                $tariff['title'],
                $tariff['currency'],
                $tariff['min_sum']
            );
        }

        return $tariffs;
    }
}