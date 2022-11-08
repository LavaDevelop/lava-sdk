<?php

namespace Lava\Api\Contracts\Refund;

use Lava\Api\Dto\Request\Refund\CreateRefundDto;
use Lava\Api\Dto\Response\Refund\CreatedRefundDto;

interface CreateRefundContract
{

    /**
     * @param CreateRefundDto $refundDto
     * @param string $shopId
     * @return array
     */
    public function toArray(CreateRefundDto $refundDto, string $shopId): array;

    /**
     * @param array $refund
     * @return CreatedRefundDto
     */
    public function toDto(array $refund): CreatedRefundDto;

}