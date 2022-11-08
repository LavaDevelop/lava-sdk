<?php

namespace Lava\Api\Dto\Request\Refund;

class CreateRefundDto
{

    private string $invoiceId;
    private ?string $description;
    private ?float $amount;

    /**
     * @param string $invoiceId
     * @param string|null $description
     * @param float|null $amount
     */
    public function __construct(string $invoiceId, ?string $description = null, ?float $amount = null)
    {
        $this->invoiceId = $invoiceId;
        $this->description = $description;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

}