<?php

namespace Lava\Api\Http\Payoffs;

use Lava\Api\Contracts\Payoff\CheckWalletContract;
use Lava\Api\Dto\Request\Payoff\CheckWalletRequestDto;
use Lava\Api\Dto\Response\Payoff\CheckWalletResponseDto;
use Lava\Api\Exceptions\BaseException;

class CheckWalletDto implements CheckWalletContract
{


    /**
     * @param CheckWalletRequestDto $payoffDto
     * @param string $shopId
     * @return array
     */
    public function toArray(CheckWalletRequestDto $payoffDto, string $shopId): array
    {
        return [
            'shopId' => $shopId,
            'service' => $payoffDto->getService(),
            'walletTo' => $payoffDto->getWallet(),
        ];
    }

    /**
     * @param array $response
     * @return CheckWalletResponseDto
     * @throws BaseException
     */
    public function toDto(array $response): CheckWalletResponseDto
    {

        if (empty($response['data'])) {
            throw new BaseException('Empty data');
        }

        $data = $response['data'];

        return new CheckWalletResponseDto(
            $data['status'],
        );
    }

}