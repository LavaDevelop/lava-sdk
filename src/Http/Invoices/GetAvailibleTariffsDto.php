<?php

namespace Lava\Api\Http\Invoices;

use Lava\Api\Contracts\Invoice\GetAvailibleIpsContract;
use Lava\Api\Dto\Response\Invoice\AvailibleTariffDto;

class GetAvailibleTariffsDto implements GetAvailibleIpsContract
{

    public function toDto(array $responseData): array
    {
        $tariffs = [];

        foreach ($responseData['data'] as $tariff) {
            $tariffs[] = new AvailibleTariffDto(
                $tariff['status'],
                $tariff['percent'],
                $tariff['user_percent'],
                $tariff['shop_percent'],
                $tariff['service_name'],
                $tariff['service_id'],
                $tariff['currency'],
            );
        }

        return $tariffs;
    }
}