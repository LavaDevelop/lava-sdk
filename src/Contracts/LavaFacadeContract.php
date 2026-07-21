<?php

namespace Lava\Api\Contracts;

use JsonException;
use Lava\Api\Dto\Request\Invoice\CreateInvoiceDto;
use Lava\Api\Dto\Request\Invoice\GetStatusInvoiceDto;
use Lava\Api\Dto\Request\Payoff\CheckWalletRequestDto;
use Lava\Api\Dto\Request\Payoff\CreatePayoffDto;
use Lava\Api\Dto\Request\Payoff\GetPayoffStatusDto;
use Lava\Api\Dto\Request\Refund\CreateRefundDto;
use Lava\Api\Dto\Request\Refund\GetStatusRefundDto;
use Lava\Api\Dto\Request\Recurrent\CreateConsumerDto;
use Lava\Api\Dto\Request\Recurrent\CreateSubscriptionDto;
use Lava\Api\Dto\Request\Recurrent\GetSubscriptionStatusDto;
use Lava\Api\Dto\Request\Recurrent\OffsetNextPayTimeDto;
use Lava\Api\Dto\Request\Recurrent\UnsubscribeDto;
use Lava\Api\Dto\Response\Invoice\AvailibleTariffDto;
use Lava\Api\Dto\Response\Invoice\CreatedInvoiceDto;
use Lava\Api\Dto\Response\Invoice\StatusInvoiceDto;
use Lava\Api\Dto\Response\Payoff\CheckWalletResponseDto;
use Lava\Api\Dto\Response\Payoff\CreatedPayoffDto;
use Lava\Api\Dto\Response\Payoff\StatusPayoffDto;
use Lava\Api\Dto\Response\Refund\CreatedRefundDto;
use Lava\Api\Dto\Response\Refund\StatusRefundDto;
use Lava\Api\Dto\Response\Shop\ShopBalanceDto;
use Lava\Api\Dto\Response\Recurrent\ConsumerDto;
use Lava\Api\Dto\Response\Recurrent\CreatedSubscriptionDto;
use Lava\Api\Dto\Response\Recurrent\OffsetNextPayTimeResponseDto;
use Lava\Api\Dto\Response\Recurrent\SubscriptionStatusDto;
use Lava\Api\Dto\Response\Recurrent\UnsubscribedSubscriptionDto;
use Lava\Api\Exceptions\BaseException;
use Lava\Api\Exceptions\Invoice\InvoiceException;
use Lava\Api\Exceptions\Payoff\CheckWalletException;

interface LavaFacadeContract
{

    /**
     * @param CreateInvoiceDto $invoice
     *
     * @return CreatedInvoiceDto
     */
    public function createInvoice(CreateInvoiceDto $invoice): CreatedInvoiceDto;

    /**
     * @param GetStatusInvoiceDto $statusInvoice
     *
     * @return StatusInvoiceDto
     */
    public function checkStatusInvoice(GetStatusInvoiceDto $statusInvoice): StatusInvoiceDto;

    /**
     * @param CreateRefundDto $refundDto
     *
     * @return CreatedRefundDto
     */
    public function createRefund(CreateRefundDto $refundDto): CreatedRefundDto;

    /**
     * @param GetStatusRefundDto $refundDto
     *
     * @return StatusRefundDto
     */
    public function checkStatusRefund(GetStatusRefundDto $refundDto): StatusRefundDto;

    /**
     * @return ShopBalanceDto
     */
    public function getShopBalance(): ShopBalanceDto;

    /**
     * @param CreatePayoffDto $payoff
     *
     * @return CreatedPayoffDto
     */
    public function createPayoff(CreatePayoffDto $payoff): CreatedPayoffDto;

    /**
     * @param GetPayoffStatusDto $payoffStatus
     *
     * @return StatusPayoffDto
     */
    public function getStatusPayoff(GetPayoffStatusDto $payoffStatus): StatusPayoffDto;

    /**
     * @param string $webhookResponse
     * @param string $signature
     *
     * @return bool
     */
    public function checkSignWebhook(string $webhookResponse, string $signature): bool;

    /**
     * @throws JsonException
     * @throws BaseException
     * @throws CheckWalletException
     */
    public function getPayoffTariffs(): array;

    /**
     * @param CheckWalletRequestDto $checkWallet
     *
     * @return CheckWalletResponseDto
     * @throws BaseException
     * @throws CheckWalletException
     * @throws JsonException
     */
    public function checkWallet(CheckWalletRequestDto $checkWallet): CheckWalletResponseDto;


    /**
     * @return array<AvailibleTariffDto>
     * @throws BaseException
     * @throws InvoiceException
     * @throws JsonException
     */
    public function getAvailibleTariffs(): array;

    public function getRecurrentProducts(): array;

    public function createRecurrentConsumer(CreateConsumerDto $consumer): ConsumerDto;

    public function createSubscription(CreateSubscriptionDto $subscription): CreatedSubscriptionDto;

    public function getSubscriptionStatus(GetSubscriptionStatusDto $subscription): SubscriptionStatusDto;

    public function offsetSubscriptionNextPayTime(OffsetNextPayTimeDto $offset): OffsetNextPayTimeResponseDto;

    public function unsubscribe(UnsubscribeDto $subscription): UnsubscribedSubscriptionDto;

}
