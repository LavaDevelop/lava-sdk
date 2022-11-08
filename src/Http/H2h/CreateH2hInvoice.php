<?php

namespace Lava\Api\Http\H2h;

use Lava\Api\Exceptions\BaseException;
use Lava\Api\Contracts\H2h\CreateH2hContract;
use Lava\Api\Dto\Response\H2h\CreatedH2hInvoiceDto;
use Lava\Api\Dto\Request\H2h\CreateH2hInvoiceDto;

class CreateH2hInvoice implements CreateH2hContract
{

    /**
     * @param CreateH2hInvoiceDto $h2hDto
     * @param string $shopId
     * @return array
     */
    public function toArray(CreateH2hInvoiceDto $h2hDto, string $shopId): array
    {
        return [
            "sum" => $h2hDto->getAmount(),
            "orderId" => $h2hDto->getOrderId(),
            "hookUrl" => $h2hDto->getHookUrl(),
            "expire" => $h2hDto->getExpire(),
            "customFields" => $h2hDto->getCustomFields(),
            "comment" => $h2hDto->getComment(),
            "shopId" => $shopId,
            'cardNumber' => $h2hDto->getCardNumber(),
            "cvv" => $h2hDto->getCvv(),
            "month" => $h2hDto->getMonth(),
            "year" => $h2hDto->getYear(),
            'successUrl' => $h2hDto->getSuccessUrl(),
            "failUrl" => $h2hDto->getFailUrl()
        ];
    }

    /**
     * @param array $response
     * @return CreatedH2hInvoiceDto
     * @throws BaseException
     */
    public function toDto(array $response): CreatedH2hInvoiceDto
    {
        if (empty($response['data'])) {
            throw new BaseException('Empty data');
        }

        $data = $response['data'];

        return new CreatedH2hInvoiceDto(
            $data['url'],
            $data['invoiceId'],
            $data['cardMask'],
            $data['amount'],
            $data['amountPay'],
            $data['commission'],
            $data['shopId']
        );
    }
}