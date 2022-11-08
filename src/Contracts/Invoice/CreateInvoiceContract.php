<?php

namespace Lava\Api\Contracts\Invoice;

use Lava\Api\Dto\Request\Invoice\CreateInvoiceDto;
use Lava\Api\Dto\Response\Invoice\CreatedInvoiceDto;

interface CreateInvoiceContract
{

    /**
     * @param CreateInvoiceDto $invoiceDto
     * @param string $shopId
     * @return array
     */
    public function toArray(CreateInvoiceDto $invoiceDto, string $shopId): array;

    /**
     * @param array $invoice
     * @return CreatedInvoiceDto
     */
    public function toDto(array $invoice): CreatedInvoiceDto;

}