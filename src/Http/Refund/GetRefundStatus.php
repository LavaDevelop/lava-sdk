<?php

namespace Lava\Api\Http\Refund;

use Lava\Api\Exceptions\BaseException;
use Lava\Api\Contracts\Refund\GetStatusRefundContract;
use Lava\Api\Dto\Request\Refund\GetStatusRefundDto;
use Lava\Api\Dto\Response\Refund\StatusRefundDto;


class GetRefundStatus implements GetStatusRefundContract
{

    /**
     * @param GetStatusRefundDto $statusRefundDto
     * @param string $shopId
     * @return array
     */
    public function toArray(GetStatusRefundDto $statusRefundDto, string $shopId): array
    {
        return [
            'shopId' => $shopId,
            'refundId' => $statusRefundDto->getRefundId(),
        ];
    }

    /**
     * @param array $refundStatus
     * @return StatusRefundDto
     * @throws BaseException
     */
    public function responseToDto(array $refundStatus): StatusRefundDto
    {
        if (empty($refundStatus['data'])) {
            throw new BaseException('Empty data');
        }

        $data = $refundStatus['data'];

        return new StatusRefundDto(
            $data['status'],
            $data['refund_id'],
            $data['amount']
        );

    }

}