<?php

namespace Lava\Api\Contracts\Client;

interface ClientContract
{

    /**
     * @param array $data
     * @return array
     */
    public function createRefund(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function getRefundStatus(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function createInvoice(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function getInvoiceStatus(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function getShopBalance(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function createPayoff(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function getPayoffStatus(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function createH2hInvoice(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function createH2hSbp(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function checkWallet(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function getPayoffTariffs(array $data): array;
}