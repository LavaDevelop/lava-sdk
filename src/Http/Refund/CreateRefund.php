<?php

namespace Lava\Api\Http\Refund;

use Exception;
use Lava\Api\Exceptions\BaseException;
use Lava\Api\Contracts\Refund\CreateRefundContract;
use Lava\Api\Dto\Request\Refund\CreateRefundDto;
use Lava\Api\Dto\Response\Refund\CreatedRefundDto;

class CreateRefund implements CreateRefundContract
{

    /**
     * @param CreateRefundDto $refundDto
     * @param string $shopId
     * @return array
     */
    public function toArray(CreateRefundDto $refundDto, string $shopId): array
    {
        return [
            'shopId' => $shopId,
            'invoiceId' => $refundDto->getInvoiceId(),
            'amount' => $refundDto->getAmount(),
            'description' => $refundDto->getDescription(),
        ];
    }

    /**
     * @param array $refund
     * @return CreatedRefundDto
     * @throws Exception
     */
    public function toDto(array $refund): CreatedRefundDto
    {
        if (empty($refund['data'])) {
            throw new BaseException($refund['error']);
        }

        $data = $refund['data'];
        return new CreatedRefundDto(
            $data['status'],
            $data['refund_id'],
            $data['amount'],
            $data['service'],
            $data['label'],
        );
    }
}