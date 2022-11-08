<?php

namespace Lava\Api\Contracts\Refund;

use Lava\Api\Dto\Request\Refund\GetStatusRefundDto;
use Lava\Api\Dto\Response\Refund\StatusRefundDto;

interface GetStatusRefundContract
{

    /**
     * @param GetStatusRefundDto $statusRefundDto
     * @param string $shopId
     * @return array
     */
    public function toArray(GetStatusRefundDto $statusRefundDto, string $shopId): array;

    /**
     * @param array $refundStatus
     * @return StatusRefundDto
     */
    public function responseToDto(array $refundStatus): StatusRefundDto;


}