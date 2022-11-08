<?php

namespace Feature\H2h;

use Exception;
use JsonException;
use Lava\Api\Dto\Request\H2h\CreateH2hInvoiceDto;
use Lava\Api\Dto\Request\H2h\CreateSBPH2HDto;
use Lava\Api\Dto\Response\H2h\CreatedH2hInvoiceDto;
use Lava\Api\Dto\Response\H2h\CreatedSBPH2hDto;
use Lava\Api\Exceptions\BaseException;
use Lava\Api\Exceptions\H2h\H2hException;
use Lava\Api\Http\LavaFacade;
use PHPUnit\Framework\TestCase;
use Test\Lava\Api\Mocks\Client\ClientErrorResponseMock;
use Test\Lava\Api\Mocks\Client\ClientSuccessResponseMock;

class H2hTest extends TestCase
{

    /**
     * @return void
     * @throws JsonException
     * @throws BaseException
     * @throws H2hException
     */
    public function testCreateH2hInvoice(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $orderId = uniqid('', true);

        $h2hCreate = new CreateH2hInvoiceDto(
            100,
            $orderId,
            701,
            11,
            30,
            '5536914283728079'
        );

        $mockClient = new ClientSuccessResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        $response = $facade->createH2hInvoice($h2hCreate);
        $this->assertEquals(CreatedH2hInvoiceDto::class, get_class($response));
    }

    /**
     * @return void
     * @throws BaseException
     * @throws H2hException
     * @throws JsonException
     */
    public function testCreateH2hSbpInvoice(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $orderId = uniqid('', true);

        $h2hCreate = new CreateSBPH2HDto(
            100,
            $orderId,
            '127.0.0.1'
        );

        $mockClient = new ClientSuccessResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        $response = $facade->createH2HSpbInvoice($h2hCreate);
        $this->assertEquals(CreatedSBPH2hDto::class, get_class($response));
    }

    /**
     * @return void
     */
    public function testFailCreateH2hInvoice(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $orderId = uniqid('', true);

        $h2hCreate = new CreateH2hInvoiceDto(
            100,
            $orderId,
            701,
            11,
            30,
            '5536914283728079'
        );

        $mockClient = new ClientErrorResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        try {
            $response = $facade->createH2hInvoice($h2hCreate);
        } catch (Exception $e) {
            $this->assertEquals('Payment method was not found for this user', $e->getMessage());
            return;
        }
        $this->assertEquals(CreatedH2hInvoiceDto::class, get_class($response));
    }

    /**
     * @return void
     */
    public function testFailCreateH2hSbpInvoice(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $orderId = uniqid('', true);

        $h2hCreate = new CreateSBPH2HDto(
            100,
            $orderId,
            '127.0.0.1'
        );

        $mockClient = new ClientErrorResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        try {
            $response = $facade->createH2HSpbInvoice($h2hCreate);
        } catch (Exception $e) {
            $this->assertEquals('Payment method was not found for this user', $e->getMessage());
            return;
        }

        $this->assertEquals(CreatedSBPH2hDto::class, get_class($response));
    }
}