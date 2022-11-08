<?php

namespace Lava\Api\Contracts\Invoice;

use Lava\Api\Dto\Request\Invoice\GetStatusInvoiceDto;
use Lava\Api\Dto\Response\Invoice\StatusInvoiceDto;

interface GetStatusInvoiceContract
{

    /**
     * @param GetStatusInvoiceDto $invoiceDto
     * @param string $shopId
     * @return array
     */
    public function toArray(GetStatusInvoiceDto $invoiceDto, string $shopId): array;

    /**
     * @param array $invoice
     * @return StatusInvoiceDto
     */
    public function toDto(array $invoice): StatusInvoiceDto;

}