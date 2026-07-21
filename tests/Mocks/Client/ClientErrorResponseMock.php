<?php

namespace Test\Lava\Api\Mocks\Client;

use JsonException;
use Lava\Api\Contracts\Client\ClientContract;
use Lava\Api\Exceptions\Course\CourseException;
use Lava\Api\Exceptions\Invoice\InvoiceException;
use Lava\Api\Exceptions\Payoff\CheckWalletException;
use Lava\Api\Exceptions\Payoff\PayoffException;
use Lava\Api\Exceptions\Profile\ProfileException;
use Lava\Api\Exceptions\Refund\RefundException;
use Lava\Api\Exceptions\Recurrent\RecurrentException;
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

    /**
     * @throws PayoffException
     * @throws JsonException
     */
    public function getAvailibleTariffs(array $data): array
    {
        $response = [
            'data' => null,
            'error' => 'Profile not found',
            'status' => 404,
            'status_check' => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new PayoffException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @throws ProfileException
     * @throws JsonException
     */
    public function getProfileBalance(array $data): array
    {
        $response = [
            'data' => null,
            'error' => 'Profile not found',
            'status' => 404,
            'status_check' => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new ProfileException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    public function getPayoffCourseList(array $data): array
    {
        $response = [
            'data' => null,
            'error' => 'Unauthorized',
            'status' => 401,
            'status_check' => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new CourseException(is_array($response['error']) ? json_encode($response['error']) : $response['error'], $response['status']);
        }

        return $response;
    }

    public function getPaymentCourseList(array $data): array
    {
        $response = [
            'data' => null,
            'error' => 'Unauthorized',
            'status' => 401,
            'status_check' => false
        ];

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new CourseException(is_array($response['error']) ? json_encode($response['error']) : $response['error'], $response['status']);
        }

        return $response;
    }

    public function getRecurrentProducts(array $data): array
    {
        return $this->recurrentError();
    }

    public function createRecurrentConsumer(array $data): array
    {
        return $this->recurrentError();
    }

    public function createSubscription(array $data): array
    {
        return $this->recurrentError();
    }

    public function getSubscriptionStatus(array $data): array
    {
        return $this->recurrentError();
    }

    public function offsetSubscriptionNextPayTime(array $data): array
    {
        return $this->recurrentError();
    }

    public function unsubscribe(array $data): array
    {
        return $this->recurrentError();
    }

    private function recurrentError(): array
    {
        throw new RecurrentException('Subscription not found', 404);
    }
}
