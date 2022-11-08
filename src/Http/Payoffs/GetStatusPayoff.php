<?php

namespace Lava\Api\Http\Payoffs;

use Lava\Api\Exceptions\BaseException;
use Lava\Api\Contracts\Payoff\GetPayoffStatusContract;
use Lava\Api\Dto\Request\Payoff\GetPayoffStatusDto;
use Lava\Api\Dto\Response\Payoff\StatusPayoffDto;

class GetStatusPayoff implements GetPayoffStatusContract
{

    /**
     * @param GetPayoffStatusDto $getPayoffStatus
     * @param string $shopId
     * @return array
     */
    public function toArray(GetPayoffStatusDto $getPayoffStatus, string $shopId): array
    {
        return [
            'shopId' => $shopId,
            'orderId' => $getPayoffStatus->getOrderId(),
            'payoffId' => $getPayoffStatus->getPayoffId()
        ];
    }

    /**
     * @param array $data
     * @return StatusPayoffDto
     * @throws BaseException
     */
    public function toDto(array $data): StatusPayoffDto
    {
        if (empty($data['data'])) {
            throw new BaseException('Data is empty');
        }

        $data = $data['data'];

        return new StatusPayoffDto(
           $data['id'],
            $data['orderId'],
            $data['status'],
            $data['wallet'],
            $data['service'],
            $data['amountPay'],
            $data['commission'],
            $data['amountReceive'],
            $data['tryCount'],
            $data['errorMessage']
        );
    }
}