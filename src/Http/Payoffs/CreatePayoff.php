<?php


namespace Lava\Api\Http\Payoffs;

use Lava\Api\Exceptions\BaseException;
use Lava\Api\Contracts\Payoff\CreatePayoffContract;
use Lava\Api\Dto\Request\Payoff\CreatePayoffDto;
use Lava\Api\Dto\Response\Payoff\CreatedPayoffDto;

class CreatePayoff implements CreatePayoffContract
{

    /**
     * @param CreatePayoffDto $payoffDto
     * @param string $shopId
     * @return array
     */
    public function toArray(CreatePayoffDto $payoffDto, string $shopId): array
    {
        return [
            'shopId' => $shopId,
            'amount' => $payoffDto->getAmount(),
            'service' => $payoffDto->getService(),
            'walletTo' => $payoffDto->getWalletTo(),
            'subtract' => $payoffDto->getSubtract(),
            'hookUrl' => $payoffDto->getHookUrl(),
            'orderId' => $payoffDto->getOrderId()
        ];
    }

    /**
     * @param array $response
     * @return CreatedPayoffDto
     * @throws BaseException
     */
    public function toDto(array $response): CreatedPayoffDto
    {

        if (empty($response['data'])) {
            throw new BaseException('Empty data');
        }

        $data = $response['data'];

        return new CreatedPayoffDto(
            $data['payoff_id'],
            $data['payoff_status']
        );
    }
}