<?php

namespace Lava\Api\Http\Client;

use JsonException;
use Lava\Api\Constants\CourseUrlConstants;
use Lava\Api\Constants\InvoiceUrlConstants;
use Lava\Api\Constants\Payoff\CheckWalletPayoffService;
use Lava\Api\Constants\Payoff\PayoffServiceContract;
use Lava\Api\Constants\PayoffUrlConstants;
use Lava\Api\Constants\ProfileUrlConstants;
use Lava\Api\Constants\RefundUrlConstants;
use Lava\Api\Constants\RecurrentUrlConstants;
use Lava\Api\Constants\ShopUrlConstants;
use Lava\Api\Contracts\Client\ClientContract;
use Lava\Api\Contracts\Client\HttpClientContract;
use Lava\Api\Exceptions\BaseException;
use Lava\Api\Exceptions\Course\CourseException;
use Lava\Api\Exceptions\Invoice\InvoiceException;
use Lava\Api\Exceptions\Payoff\CheckWalletException;
use Lava\Api\Exceptions\Payoff\ErrorGetPayoffTariffException;
use Lava\Api\Exceptions\Payoff\PayoffException;
use Lava\Api\Exceptions\Payoff\PayoffServiceException;
use Lava\Api\Exceptions\Profile\ProfileException;
use Lava\Api\Exceptions\Refund\RefundException;
use Lava\Api\Exceptions\Recurrent\RecurrentException;
use Lava\Api\Exceptions\Shop\ShopException;

class Client implements ClientContract
{

    /**
     * @var HttpClientContract|HttpClient
     */
    private HttpClientContract $httpClient;

    public function __construct()
    {
        $this->httpClient = new HttpClient();
    }

    /**
     * @param HttpClientContract $httpClient
     *
     * @return void
     */
    public function setHttpClient(HttpClientContract $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws JsonException|RefundException|BaseException
     */
    public function createRefund(array $data): array
    {
        $request = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->postRequest(RefundUrlConstants::CREATE_REFUND, $request);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new RefundException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws JsonException|RefundException|BaseException
     */
    public function getRefundStatus(array $data): array
    {
        $request = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->postRequest(RefundUrlConstants::GET_STATUS_REFUND, $request);
        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new RefundException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws JsonException
     * @throws ShopException|BaseException
     */
    public function getShopBalance(array $data): array
    {
        $request = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->postRequest(ShopUrlConstants::GET_BALANCE, $request);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new ShopException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws JsonException
     * @throws InvoiceException|BaseException
     */
    public function createInvoice(array $data): array
    {
        $request = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->postRequest(InvoiceUrlConstants::INVOICE_CREATE, $request);
        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new InvoiceException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws InvoiceException
     * @throws JsonException|BaseException
     */
    public function getInvoiceStatus(array $data): array
    {
        if (empty($data['orderId']) && empty($data['invoiceId'])) {
            throw new InvoiceException('orderId or invoiceId required', 422);
        }

        $request = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->postRequest(InvoiceUrlConstants::INVOICE_STATUS, $request);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new InvoiceException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws JsonException
     * @throws PayoffException|PayoffServiceException|BaseException
     */
    public function createPayoff(array $data): array
    {
        $request = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->postRequest(PayoffUrlConstants::CREATE_PAYOFF, $request);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new PayoffException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws JsonException
     * @throws PayoffException|BaseException
     */
    public function getPayoffStatus(array $data): array
    {
        if (empty($data['orderId']) && empty($data['payoffId'])) {
            throw new PayoffException('orderId or invoiceId required', 422);
        }

        $request = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->postRequest(PayoffUrlConstants::GET_PAYOFF_STATUS, $request);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new PayoffException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws BaseException
     * @throws CheckWalletException
     * @throws JsonException
     */
    public function checkWallet(array $data): array
    {
        $request = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->postRequest(PayoffUrlConstants::CHECK_USER_WALLET, $request, 35);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new CheckWalletException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws BaseException
     * @throws JsonException
     * @throws ErrorGetPayoffTariffException
     */
    public function getPayoffTariffs(array $data): array
    {
        $request = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->postRequest(PayoffUrlConstants::GET_PAYOFF_TARIFFS, $request);

        if (!empty($response['error']) || $response['status'] !== 200 || empty($response['data']['tariffs'])) {
            throw new ErrorGetPayoffTariffException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @throws JsonException
     * @throws BaseException|InvoiceException
     */
    public function getAvailibleTariffs(array $data): array
    {
        $request = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->postRequest(InvoiceUrlConstants::GET_AVAILIBLE_TARIFFS, $request);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new InvoiceException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @param array $data
     * @return array
     * @throws BaseException
     * @throws JsonException
     */
    public function getProfileBalance(array $data): array
    {
        $response = $this->httpClient->getRequest(ProfileUrlConstants::GET_BALANCE, $data);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new ProfileException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @throws JsonException
     * @throws BaseException
     */
    public function getPaymentCourseList(array $data): array
    {
        $response = $this->httpClient->getRequest(CourseUrlConstants::GET_PAYMENT_COURSE_LIST, $data);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new CourseException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @throws JsonException
     * @throws BaseException
     */
    public function getPayoffCourseList(array $data): array
    {
        $response = $this->httpClient->getRequest(CourseUrlConstants::GET_PAYOFF_COURSE_LIST, $data);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new CourseException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    public function getRecurrentProducts(array $data): array
    {
        return $this->recurrentRequest(RecurrentUrlConstants::PRODUCT_LIST, $data);
    }

    public function createRecurrentConsumer(array $data): array
    {
        return $this->recurrentRequest(RecurrentUrlConstants::CONSUMER_CREATE, $data);
    }

    public function createSubscription(array $data): array
    {
        return $this->recurrentRequest(RecurrentUrlConstants::SUBSCRIPTION_SUBSCRIBE, $data);
    }

    public function getSubscriptionStatus(array $data): array
    {
        $this->ensureSubscriptionIdentifier($data);

        return $this->recurrentRequest(RecurrentUrlConstants::SUBSCRIPTION_STATUS, $data);
    }

    public function offsetSubscriptionNextPayTime(array $data): array
    {
        $this->ensureSubscriptionIdentifier($data);

        return $this->recurrentRequest(RecurrentUrlConstants::SUBSCRIPTION_OFFSET_NEXT_PAY_TIME, $data);
    }

    public function unsubscribe(array $data): array
    {
        $this->ensureSubscriptionIdentifier($data);

        return $this->recurrentRequest(RecurrentUrlConstants::SUBSCRIPTION_UNSUBSCRIBE, $data);
    }

    private function recurrentRequest(string $url, array $data): array
    {
        $request = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->postRequest($url, $request);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new RecurrentException(is_array($response['error']) ? json_encode($response['error'], JSON_THROW_ON_ERROR) : $response['error'], $response['status']);
        }

        return $response;
    }

    private function ensureSubscriptionIdentifier(array $data): void
    {
        if (empty($data['subscriptionId']) && empty($data['orderId'])) {
            throw new RecurrentException('subscriptionId or orderId required', 422);
        }
    }
}
