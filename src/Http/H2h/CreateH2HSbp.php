<?php

namespace Lava\Api\Http\H2h;

use Lava\Api\Exceptions\BaseException;
use Lava\Api\Contracts\H2h\CreateSBPH2hContract;
use Lava\Api\Dto\Response\H2h\CreatedSBPH2hDto;
use Lava\Api\Dto\Request\H2h\CreateSBPH2HDto;

class CreateH2HSbp implements CreateSBPH2hContract
{

    /**
     * @param CreateSBPH2HDto $h2hDto
     * @param string $shopId
     * @return array
     */
    public function toArray(CreateSBPH2HDto $h2hDto, string $shopId): array
    {
        return [
            "sum" => $h2hDto->getAmount(),
            "orderId" => $h2hDto->getOrderId(),
            "hookUrl" => $h2hDto->getHookUrl(),
            "expire" => $h2hDto->getExpire(),
            "customFields" => $h2hDto->getCustomFields(),
            "comment" => $h2hDto->getComment(),
            "shopId" => $shopId,
            "ip" => $h2hDto->getIp(),
            "successUrl" => $h2hDto->getSuccessUrl(),
            "failUrl" => $h2hDto->getFailUrl(),
        ];
    }

    /**
     * @param array $invoice
     * @return CreatedSBPH2hDto
     * @throws BaseException
     */
    public function toDto(array $invoice): CreatedSBPH2hDto
    {
        if (empty($invoice['data'])) {
            throw new BaseException('Empty data');
        }

        $data = $invoice['data'];

        return new CreatedSBPH2hDto(
            $data['sbp_url'],
            $data['fingerprint'],
            $data['qr_code']
        );
    }
}