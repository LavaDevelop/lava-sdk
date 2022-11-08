<?php

namespace Lava\Api\Contracts\Shop;

use Lava\Api\Dto\Response\Shop\ShopBalanceDto;

interface GetShopBalanceContract
{

    /**
     * @param string $shopId
     * @return array
     */
    public function toArray(string $shopId): array;

    /**
     * @param array $response
     * @return ShopBalanceDto
     */
    public function toDto(array $response): ShopBalanceDto;

}