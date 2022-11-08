<?php

namespace Lava\Api\Contracts\H2h;

use Lava\Api\Dto\Response\H2h\CreatedSBPH2hDto;
use Lava\Api\Dto\Request\H2h\CreateSBPH2HDto;

interface CreateSBPH2hContract
{

    /**
     * @param CreateSBPH2HDto $h2hDto
     * @param string $shopId
     * @return array
     */
    public function toArray(CreateSBPH2HDto $h2hDto, string $shopId): array;

    /**
     * @param array $invoice
     * @return CreatedSBPH2hDto
     */
    public function toDto(array $invoice): CreatedSBPH2hDto;

}