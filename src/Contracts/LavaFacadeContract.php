<?php

namespace Lava\Api\Contracts;

use JsonException;
use Lava\Api\Dto\Request\H2h\CreateH2hInvoiceDto;
use Lava\Api\Dto\Request\H2h\CreateSBPH2HDto;
use Lava\Api\Dto\Request\Invoice\CreateInvoiceDto;
use Lava\Api\Dto\Request\Invoice\GetStatusInvoiceDto;
use Lava\Api\Dto\Request\Payoff\CheckWalletRequestDto;
use Lava\Api\Dto\Request\Payoff\CreatePayoffDto;
use Lava\Api\Dto\Request\Payoff\GetPayoffStatusDto;
use Lava\Api\Dto\Request\Refund\CreateRefundDto;
use Lava\Api\Dto\Request\Refund\GetStatusRefundDto;
use Lava\Api\Dto\Response\H2h\CreatedH2hInvoiceDto;
use Lava\Api\Dto\Response\H2h\CreatedSBPH2hDto;
use Lava\Api\Dto\Response\Invoice\CreatedInvoiceDto;
use Lava\Api\Dto\Response\Invoice\StatusInvoiceDto;
use Lava\Api\Dto\Response\Payoff\CheckWalletResponseDto;
use Lava\Api\Dto\Response\Payoff\CreatedPayoffDto;
use Lava\Api\Dto\Response\Payoff\StatusPayoffDto;
use Lava\Api\Dto\Response\Refund\CreatedRefundDto;
use Lava\Api\Dto\Response\Refund\StatusRefundDto;
use Lava\Api\Dto\Response\Shop\ShopBalanceDto;
use Lava\Api\Exceptions\BaseException;
use Lava\Api\Exceptions\Payoff\CheckWalletException;

interface LavaFacadeContract
{

    /**
     * @param CreateInvoiceDto $invoice
     * @return CreatedInvoiceDto
     */
    public function createInvoice(CreateInvoiceDto $invoice): CreatedInvoiceDto;

    /**
     * @param GetStatusInvoiceDto $statusInvoice
     * @return StatusInvoiceDto
     */
    public function checkStatusInvoice(GetStatusInvoiceDto $statusInvoice): StatusInvoiceDto;

    /**
     * @param CreateRefundDto $refundDto
     * @return CreatedRefundDto
     */
    public function createRefund(CreateRefundDto $refundDto): CreatedRefundDto;

    /**
     * @param GetStatusRefundDto $refundDto
     * @return StatusRefundDto
     */
    public function checkStatusRefund(GetStatusRefundDto $refundDto): StatusRefundDto;

    /**
     * @return ShopBalanceDto
     */
    public function getShopBalance(): ShopBalanceDto;

    /**
     * @param CreatePayoffDto $payoff
     * @return CreatedPayoffDto
     */
    public function createPayoff(CreatePayoffDto $payoff): CreatedPayoffDto;

    /**
     * @param GetPayoffStatusDto $payoffStatus
     * @return StatusPayoffDto
     */
    public function getStatusPayoff(GetPayoffStatusDto $payoffStatus): StatusPayoffDto;

    /**
     * @param string $webhookResponse
     * @param string $signature
     * @return bool
     */
    public function checkSignWebhook(string $webhookResponse, string $signature): bool;

    /**
     * @param CreateH2hInvoiceDto $h2HInvoiceDto
     * @return CreatedH2hInvoiceDto
     */
    public function createH2hInvoice(CreateH2hInvoiceDto $h2HInvoiceDto): CreatedH2hInvoiceDto;

    /**
     * @param CreateSBPH2HDto $h2HInvoiceDto
     * @return CreatedSBPH2hDto
     */
    public function createH2HSpbInvoice(CreateSBPH2HDto $h2HInvoiceDto): CreatedSBPH2hDto;

    /**
     * @throws JsonException
     * @throws BaseException
     * @throws CheckWalletException
     */
    public function getPayoffTariffs(): array;

    public function checkWallet(CheckWalletRequestDto $checkWallet): CheckWalletResponseDto;

}