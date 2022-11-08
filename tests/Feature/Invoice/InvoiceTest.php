<?php

namespace Feature\Invoice;

use Exception;
use JsonException;
use Lava\Api\Dto\Request\Invoice\CreateInvoiceDto;
use Lava\Api\Dto\Request\Invoice\GetStatusInvoiceDto;
use Lava\Api\Dto\Response\Invoice\CreatedInvoiceDto;
use Lava\Api\Dto\Response\Invoice\StatusInvoiceDto;
use Lava\Api\Exceptions\BaseException;
use Lava\Api\Exceptions\Invoice\InvoiceException;
use Lava\Api\Http\LavaFacade;
use PHPUnit\Framework\TestCase;
use Test\Lava\Api\Mocks\Client\ClientErrorResponseMock;
use Test\Lava\Api\Mocks\Client\ClientSuccessResponseMock;

class InvoiceTest extends TestCase
{

    /**
     * @return void
     * @throws BaseException
     * @throws JsonException
     * @throws InvoiceException
     */
    public function testCreateInvoice(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $orderId = uniqid('', true);

        $createInvoice = new CreateInvoiceDto(
            300,
            $orderId
        );

        $mockClient = new ClientSuccessResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        $response = $facade->createInvoice($createInvoice);

        $this->assertEquals(CreatedInvoiceDto::class, get_class($response));
    }

    /**
     * @return void
     */
    public function testFailCreateInvoice(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $orderId = uniqid('', true);

        $createInvoice = new CreateInvoiceDto(
            300,
            $orderId
        );

        $mockClient = new ClientErrorResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        try {
            $response = $facade->createInvoice($createInvoice);
        } catch (Exception $e) {
            $this->assertEquals('OrderId must be uniq', $e->getMessage());
            return;
        }
        $this->assertNotEquals(CreatedInvoiceDto::class, get_class($response));
    }

    /**
     * @return void
     * @throws BaseException
     * @throws InvoiceException
     * @throws JsonException
     */
    public function testGetStatusInvoice(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $invoiceId = uniqid('', true);

        $statusInvoice = new GetStatusInvoiceDto(null, $invoiceId);
        $mockClient = new ClientSuccessResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);

        $response = $facade->checkStatusInvoice($statusInvoice);

        $this->assertEquals(StatusInvoiceDto::class, get_class($response));
    }


    /**
     * @return void
     */
    public function testFailStatusInvoice(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $invoiceId = uniqid('', true);

        $statusInvoice = new GetStatusInvoiceDto(
            300,
            $invoiceId
        );
        $mockClient = new ClientErrorResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        try {
            $response = $facade->checkStatusInvoice($statusInvoice);
        } catch (Exception $e) {
            $this->assertEquals('Invoice not found', $e->getMessage());
            return;
        }
        $this->assertNotEquals(StatusInvoiceDto::class, get_class($response));
    }

}