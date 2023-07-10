<?php

namespace Lava\Api\Contracts\Payoff;

use Lava\Api\Dto\Request\Payoff\CheckWalletRequestDto;
use Lava\Api\Dto\Response\Payoff\CheckWalletResponseDto;
use Lava\Api\Exceptions\BaseException;

interface CheckWalletContract
{

    /**
     * @param CheckWalletRequestDto $payoffDto
     * @param string $shopId
     * @return array
     */
    public function toArray(CheckWalletRequestDto $payoffDto, string $shopId): array;

    /**
     * @param array $response
     * @return CheckWalletResponseDto
     * @throws BaseException
     */
    public function toDto(array $response): CheckWalletResponseDto;

}