<?php

namespace Lava\Api\Http\Invoices;

use Lava\Api\Exceptions\BaseException;
use Lava\Api\Contracts\Invoice\GetStatusInvoiceContract;
use Lava\Api\Dto\Request\Invoice\GetStatusInvoiceDto;
use Lava\Api\Dto\Response\Invoice\StatusInvoiceDto;


class GetStatusInvoice implements GetStatusInvoiceContract
{

    /**
     * @param GetStatusInvoiceDto $invoiceDto
     * @param string $shopId
     * @return array
     */
    public function toArray(GetStatusInvoiceDto $invoiceDto, string $shopId): array
    {
        return [
            'shopId' => $shopId,
            'orderId' => $invoiceDto->getOrderId(),
            'invoiceId' => $invoiceDto->getInvoiceId()
        ];
    }

    /**
     * @param array $invoice
     * @return StatusInvoiceDto
     * @throws BaseException
     */
    public function toDto(array $invoice): StatusInvoiceDto
    {
        if (empty($invoice['data'])) {
            throw new BaseException('Empty data');
        }

        $data = $invoice['data'];

        return new StatusInvoiceDto(
            $data['status'],
            $data['error_message'],
            $data['id'],
            $data['shop_id'],
            $data['amount'],
            $data['expire'],
            $data['order_id'],
            $data['fail_url'],
            $data['success_url'],
            $data['hook_url'],
            $data['custom_fields'],
            $data['include_service'],
            $data['exclude_service']
        );
    }
}