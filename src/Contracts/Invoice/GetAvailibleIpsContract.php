<?php

namespace Lava\Api\Contracts\Invoice;

use Lava\Api\Dto\Response\Invoice\AvailibleTariffDto;

interface GetAvailibleIpsContract {


    /**
     * @param array $responseData
     *
     * @return array<AvailibleTariffDto>
     */
    public function toDto(array $responseData): array;

}