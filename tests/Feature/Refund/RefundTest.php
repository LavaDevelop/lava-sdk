<?php

namespace Feature\Refund;

use Exception;
use JsonException;
use Lava\Api\Dto\Request\Refund\CreateRefundDto;
use Lava\Api\Dto\Request\Refund\GetStatusRefundDto;
use Lava\Api\Dto\Response\Invoice\CreatedInvoiceDto;
use Lava\Api\Dto\Response\Refund\CreatedRefundDto;
use Lava\Api\Dto\Response\Refund\StatusRefundDto;
use Lava\Api\Http\LavaFacade;
use PHPUnit\Framework\TestCase;
use Test\Lava\Api\Mocks\Client\ClientErrorResponseMock;
use Test\Lava\Api\Mocks\Client\ClientSuccessResponseMock;

class RefundTest extends TestCase
{

    /**
     * @return void
     * @throws JsonException
     */
    public function testCreateRefund(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $invoiceId = uniqid('', true);

        $refundCreate = new CreateRefundDto(
            $invoiceId,
        );

        $mockClient = new ClientSuccessResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        $response = $facade->createRefund($refundCreate);
        $this->assertEquals(CreatedRefundDto::class, get_class($response));
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function testGetStatusRefund(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $refundId = uniqid('', true);

        $refundGetStatus = new GetStatusRefundDto(
            $refundId,
        );

        $mockClient = new ClientSuccessResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        $response = $facade->checkStatusRefund($refundGetStatus);

        $this->assertEquals(StatusRefundDto::class, get_class($response));
    }

    /**
     * @return void
     */
    public function testFailCreateRefund(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $invoiceId = uniqid('', true);

        $refundCreate = new CreateRefundDto(
            $invoiceId,
        );
        $mockClient = new ClientErrorResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        try {
            $response = $facade->createRefund($refundCreate);
        } catch (Exception $e) {
            $this->assertEquals('Invoice not found', $e->getMessage());
            return;
        }

        $this->assertNotEquals(CreatedInvoiceDto::class, get_class($response));
    }

    /**
     * @return void
     */
    public function testGetFailStatusRefund(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $refundId = uniqid('', true);

        $refundGetStatus = new GetStatusRefundDto(
            $refundId,
        );

        $mockClient = new ClientErrorResponseMock();
        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        try {
            $response = $facade->checkStatusRefund($refundGetStatus);
        } catch (Exception $e) {
            $this->assertEquals('Refund not found', $e->getMessage());
            return;
        }

        $this->assertNotEquals(CreatedInvoiceDto::class, get_class($response));
    }

}