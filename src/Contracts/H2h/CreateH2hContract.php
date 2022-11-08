<?php

namespace Lava\Api\Contracts\H2h;

use Lava\Api\Dto\Response\H2h\CreatedH2hInvoiceDto;
use Lava\Api\Dto\Request\H2h\CreateH2hInvoiceDto;

interface CreateH2hContract
{

    /**
     * @param CreateH2hInvoiceDto $h2hDto
     * @param string $shopId
     * @return array
     */
    public function toArray(CreateH2hInvoiceDto $h2hDto, string $shopId): array;

    /**
     * @param array $response
     * @return CreatedH2hInvoiceDto
     */
    public function toDto(array $response): CreatedH2hInvoiceDto;


}