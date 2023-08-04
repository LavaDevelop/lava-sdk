<?php

namespace Test\Lava\Api\Mocks\Client;

use Lava\Api\Contracts\Client\ClientContract;
use Lava\Api\Exceptions\Invoice\InvoiceException;
use Lava\Api\Exceptions\Payoff\CheckWalletException;
use Lava\Api\Exceptions\Payoff\PayoffException;
use Lava\Api\Exceptions\Refund\RefundException;
use Lava\Api\Exceptions\Shop\ShopException;

class ClientErrorResponseMock implements ClientContract
{

    /**
     * @param array $data
     * @return array
     * @throws RefundException
     */
    public function createRefund(array $data): array
    {
        $response = [
            "data" => null,
            "error" => 'Invoice not found',
            "status" => 404,
            "status_check" => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new RefundException($response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     * @return array
     * @throws RefundException
     */
    public function getRefundStatus(array $data): array
    {
        $response = [
            "data" => null,
            "error" => 'Refund not found',
            "status" => 404,
            "status_check" => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new RefundException($response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     * @return array
     * @throws InvoiceException
     */
    public function createInvoice(array $data): array
    {
        $response = [
            "data" => null,
            "error" => 'OrderId must be uniq',
            "status" => 422,
            "status_check" => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new InvoiceException($response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     * @return array
     * @throws ShopException
     */
    public function getInvoiceStatus(array $data): array
    {

        $response = [
            'data' => null,
            'error' => 'Invoice not found',
            'status' => 404,
            'status_check' => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new ShopException($response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     * @return array
     * @throws ShopException
     */
    public function getShopBalance(array $data): array
    {
        $response = [
            'data' => null,
            'error' => 'Field shopId is required',
            'status' => 422,
            'status_check' => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new ShopException($response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     * @return array
     * @throws PayoffException
     */
    public function createPayoff(array $data): array
    {
        $response = [
            'data' => null,
            'error' => 'Insufficient balance in shop',
            'status' => 405,
            'status_check' => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new PayoffException($response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     * @return array
     * @throws PayoffException
     */
    public function getPayoffStatus(array $data): array
    {
        $response = [
            'data' => null,
            'error' => 'Payoff not found',
            'status' => 404,
            'status_check' => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new PayoffException($response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     * @return array
     * @throws PayoffException
     */
    public function createH2hInvoice(array $data): array
    {
        $response = [
            'data' => null,
            'error' => 'Payment method was not found for this user',
            'status' => 405,
            'status_check' => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new PayoffException($response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     * @return array
     * @throws PayoffException
     */
    public function createH2hSbp(array $data): array
    {
        $response = [
            'data' => null,
            'error' => 'Payment method was not found for this user',
            'status' => 405,
            'status_check' => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new PayoffException($response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     * @return array
     * @throws CheckWalletException
     */
    public function checkWallet(array $data): array
    {
        $response = [
            'data' => null,
            'error' => [
                "walletTo" => ["Account not found"]
            ],
            'status' => 422,
            'status_check' => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new CheckWalletException(is_array($response['error']) ? json_encode($response['error']) : $response['error'], $response['status']);
        }

        return $response;
    }

    public function getPayoffTariffs(array $data): array
    {
        return [];
    }
}