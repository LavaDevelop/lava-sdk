<?php

namespace Lava\Api\Contracts\Payoff;

use Lava\Api\Dto\Request\Payoff\GetPayoffStatusDto;
use Lava\Api\Dto\Response\Payoff\StatusPayoffDto;

interface GetPayoffStatusContract
{

    /**
     * @param GetPayoffStatusDto $getPayoffStatus
     * @param string $shopId
     * @return array
     */
    public function toArray(GetPayoffStatusDto $getPayoffStatus, string $shopId): array;

    /**
     * @param array $data
     * @return StatusPayoffDto
     */
    public function toDto(array $data): StatusPayoffDto;

}