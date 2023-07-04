<?php

namespace Feature\Payoff;

use Exception;
use JsonException;
use Lava\Api\Dto\Request\Payoff\CheckWalletRequestDto;
use Lava\Api\Dto\Request\Payoff\CreatePayoffDto;
use Lava\Api\Dto\Request\Payoff\GetPayoffStatusDto;
use Lava\Api\Dto\Response\Payoff\CheckWalletResponseDto;
use Lava\Api\Dto\Response\Payoff\CreatedPayoffDto;
use Lava\Api\Dto\Response\Payoff\StatusPayoffDto;
use Lava\Api\Exceptions\BaseException;
use Lava\Api\Exceptions\Payoff\CheckWalletException;
use Lava\Api\Exceptions\Payoff\PayoffException;
use Lava\Api\Exceptions\Payoff\PayoffServiceException;
use Lava\Api\Http\LavaFacade;
use PHPUnit\Framework\TestCase;
use Test\Lava\Api\Mocks\Client\ClientErrorResponseMock;
use Test\Lava\Api\Mocks\Client\ClientSuccessResponseMock;

class PayoffTest extends TestCase
{

    /**
     * @return void
     * @throws JsonException
     * @throws BaseException
     * @throws PayoffException
     * @throws PayoffServiceException
     */
    public function testCreatePayoff(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $orderId = uniqid('', true);

        $payoffCreate = new CreatePayoffDto($orderId, 10, 'lava_payoff');

        $mockClient = new ClientSuccessResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        $response = $facade->createPayoff($payoffCreate);

        $this->assertEquals(CreatedPayoffDto::class, get_class($response));
    }

    /**
     * @return void
     * @throws BaseException
     * @throws JsonException
     * @throws PayoffException
     */
    public function testGetStatus(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $payoffId = uniqid('', true);

        $payoffStatus = new GetPayoffStatusDto(null, $payoffId);

        $mockClient = new ClientSuccessResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        $response = $facade->getStatusPayoff($payoffStatus);

        $this->assertEquals(StatusPayoffDto::class, get_class($response));
    }

    /**
     * @return void
     */
    public function testCreateFailPayoff(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $orderId = uniqid('', true);

        $payoffCreate = new CreatePayoffDto($orderId, 10, 'lava_payoff');

        $mockClient = new ClientErrorResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        try {
            $response = $facade->createPayoff($payoffCreate);
        } catch (Exception $e) {
            $this->assertEquals('Insufficient balance in shop', $e->getMessage());
            return;
        }
        $this->assertNotEquals(CreatedPayoffDto::class, get_class($response));
    }

    /**
     * @return void
     */
    public function testGetFailStatus(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $payoffId = uniqid('', true);

        $payoffStatus = new GetPayoffStatusDto(null, $payoffId);

        $mockClient = new ClientErrorResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        try {
            $response = $facade->getStatusPayoff($payoffStatus);
        } catch (Exception $e) {
            $this->assertEquals('Payoff not found', $e->getMessage());
            return;
        }

        $this->assertEquals(CreatedPayoffDto::class, get_class($response));
    }

    public function testErrorCheckWalletStatus(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $walletTo = uniqid('', true);

        $checkWallet = new CheckWalletRequestDto('steam_payoff', $walletTo);

        $mockClient = new ClientErrorResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);

        try {
            $response = $facade->checkWallet($checkWallet);
        } catch (Exception $e) {
            $this->assertEquals('{"walletTo":["Account not found"]}', $e->getMessage());
            return;
        }

        $this->assertEquals(CreatedPayoffDto::class, get_class($response));
    }


    /**
     * @throws JsonException
     * @throws BaseException
     * @throws CheckWalletException
     */
    public function testSuccessCheckWalletStatus(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $walletTo = uniqid('', true);

        $checkWallet = new CheckWalletRequestDto('steam_payoff', $walletTo);

        $mockClient = new ClientSuccessResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        $response = $facade->checkWallet($checkWallet);

        $this->assertEquals(CheckWalletResponseDto::class, get_class($response));
    }

}