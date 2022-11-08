<?php

namespace Lava\Api\Dto\Request\Invoice;

class GetStatusInvoiceDto
{

    private ?string $orderId;
    private ?string $invoiceId;

    /**
     * @param string|null $orderId
     * @param string|null $invoiceId
     */
    public function __construct(?string $orderId = null, ?string $invoiceId = null)
    {
        $this->orderId = $orderId;
        $this->invoiceId = $invoiceId;
    }

    /**
     * @return string|null
     */
    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    /**
     * @return string|null
     */
    public function getInvoiceId(): ?string
    {
        return $this->invoiceId;
    }

}