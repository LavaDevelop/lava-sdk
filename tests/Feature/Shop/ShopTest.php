<?php

namespace Feature\Shop;

use Exception;
use JsonException;
use Lava\Api\Dto\Response\Shop\ShopBalanceDto;
use Lava\Api\Exceptions\BaseException;
use Lava\Api\Exceptions\Shop\ShopException;
use Lava\Api\Http\LavaFacade;
use PHPUnit\Framework\TestCase;
use Test\Lava\Api\Mocks\Client\ClientErrorResponseMock;
use Test\Lava\Api\Mocks\Client\ClientSuccessResponseMock;

class ShopTest extends TestCase
{

    /**
     * @return void
     * @throws JsonException
     * @throws BaseException
     * @throws ShopException
     */
    public function testGetShopBalance(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $mockClient = new ClientSuccessResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        $response = $facade->getShopBalance();
        $this->assertEquals(37500.08, $response->getBalance());
        $this->assertEquals(375000.08, $response->getFreezeBalance());
    }

    /**
     * @return void
     */
    public function testFailGetShopBalance(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $mockClient = new ClientErrorResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        try {
            $response = $facade->getShopBalance();
        } catch (Exception $e) {
            $this->assertEquals('Field shopId is required', $e->getMessage());
            return;
        }
        $this->assertNotEquals(ShopBalanceDto::class, $response);
    }

}