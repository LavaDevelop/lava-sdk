<?php

namespace Lava\Api\Contracts\Client;

use JsonException;
use Lava\Api\Exceptions\BaseException;

interface ClientContract
{

    /**
     * @param array $data
     *
     * @return array
     */
    public function createRefund(array $data): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function getRefundStatus(array $data): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function createInvoice(array $data): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function getInvoiceStatus(array $data): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function getShopBalance(array $data): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function createPayoff(array $data): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function getPayoffStatus(array $data): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function checkWallet(array $data): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function getPayoffTariffs(array $data): array;

    public function getAvailibleTariffs(array $data): array;

    /**
     * @param array $data
     * @return array
     * @throws BaseException
     * @throws JsonException
     */
    public function getProfileBalance(array $data): array;

    /**
     * @throws JsonException
     * @throws BaseException
     */
    public function getPaymentCourseList(array $data): array;

    /**
     * @throws JsonException
     * @throws BaseException
     */
    public function getPayoffCourseList(array $data): array;

    public function getRecurrentProducts(array $data): array;

    public function createRecurrentConsumer(array $data): array;

    public function createSubscription(array $data): array;

    public function getSubscriptionStatus(array $data): array;

    public function offsetSubscriptionNextPayTime(array $data): array;

    public function unsubscribe(array $data): array;
}
