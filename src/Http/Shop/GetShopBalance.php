<?php

namespace Lava\Api\Http\Shop;

use Lava\Api\Exceptions\BaseException;
use Lava\Api\Contracts\Shop\GetShopBalanceContract;
use Lava\Api\Dto\Response\Shop\ShopBalanceDto;

class GetShopBalance implements GetShopBalanceContract
{

    /**
     * @param string $shopId
     * @return array
     */
    public function toArray(string $shopId): array
    {
        return [
            'shopId' => $shopId
        ];
    }

    /**
     * @param array $response
     * @return ShopBalanceDto
     * @throws BaseException
     */
    public function toDto(array $response): ShopBalanceDto
    {
        if (empty($response['data'])) {
            throw new BaseException('Empty data');
        }

        $data = $response['data'];

        return new ShopBalanceDto(
            $data['balance'],
            $data['freeze_balance']
        );
    }
}