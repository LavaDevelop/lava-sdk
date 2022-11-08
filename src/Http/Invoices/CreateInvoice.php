<?php

namespace Lava\Api\Http\Invoices;

use Lava\Api\Exceptions\BaseException;
use Lava\Api\Contracts\Invoice\CreateInvoiceContract;
use Lava\Api\Dto\Request\Invoice\CreateInvoiceDto;
use Lava\Api\Dto\Response\Invoice\CreatedInvoiceDto;

class CreateInvoice implements CreateInvoiceContract
{

    /**
     * @param CreateInvoiceDto $invoiceDto
     * @param string $shopId
     * @return array
     */
    public function toArray(CreateInvoiceDto $invoiceDto, string $shopId): array
    {
        return [
            'sum' => $invoiceDto->getSum(),
            'orderId' => $invoiceDto->getOrderId(),
            'hookUrl' => $invoiceDto->getHookUrl(),
            'failUrl' => $invoiceDto->getFailUrl(),
            'successUrl' => $invoiceDto->getSuccessUrl(),
            'expire' => $invoiceDto->getExpire(),
            'customFields' => $invoiceDto->getCustomFields(),
            'comment' => $invoiceDto->getComment(),
            'includeService' => $invoiceDto->getIncludeService(),
            'excludeService' => $invoiceDto->getExcludeService(),
            'shopId' => $shopId
        ];
    }

    /**
     * @param array $invoice
     * @return CreatedInvoiceDto
     * @throws BaseException
     */
    public function toDto(array $invoice): CreatedInvoiceDto
    {
        if (empty($invoice['data'])) {
            throw new BaseException('Empty data');
        }

        $data = $invoice['data'];

        return new CreatedInvoiceDto(
            $data['id'],
            $data['amount'],
            $data['expired'],
            $data['status'],
            $data['shop_id'],
            $data['url'],
        );
    }
}