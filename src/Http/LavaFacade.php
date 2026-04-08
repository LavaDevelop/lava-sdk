<?php

namespace Lava\Api\Http;

use Exception;
use InvalidArgumentException;
use JsonException;
use Lava\Api\Contracts\Client\ClientCheckSignatureWebhookContract;
use Lava\Api\Contracts\Client\ClientContract;
use Lava\Api\Contracts\Client\ClientGenerateSignatureContract;
use Lava\Api\Contracts\LavaFacadeContract;
use Lava\Api\Dto\Request\H2h\CreateH2hInvoiceDto;
use Lava\Api\Dto\Request\H2h\CreateSBPH2HDto;
use Lava\Api\Dto\Request\Invoice\CreateInvoiceDto;
use Lava\Api\Dto\Request\Invoice\GetStatusInvoiceDto;
use Lava\Api\Dto\Request\Payoff\CheckWalletRequestDto;
use Lava\Api\Dto\Request\Payoff\CreatePayoffDto;
use Lava\Api\Dto\Request\Payoff\GetPayoffStatusDto;
use Lava\Api\Dto\Request\Refund\CreateRefundDto;
use Lava\Api\Dto\Request\Refund\GetStatusRefundDto;
use Lava\Api\Dto\Response\Course\CourseDto;
use Lava\Api\Dto\Response\Course\CurrencyDto;
use Lava\Api\Dto\Response\H2h\CreatedH2hInvoiceDto;
use Lava\Api\Dto\Response\H2h\CreatedSBPH2hDto;
use Lava\Api\Dto\Response\Invoice\CreatedInvoiceDto;
use Lava\Api\Dto\Response\Invoice\StatusInvoiceDto;
use Lava\Api\Dto\Response\Payoff\CheckWalletResponseDto;
use Lava\Api\Dto\Response\Payoff\CreatedPayoffDto;
use Lava\Api\Dto\Response\Payoff\StatusPayoffDto;
use Lava\Api\Dto\Response\Profile\ProfileBalanceDto;
use Lava\Api\Dto\Response\Refund\CreatedRefundDto;
use Lava\Api\Dto\Response\Refund\StatusRefundDto;
use Lava\Api\Dto\Response\Shop\ShopBalanceDto;
use Lava\Api\Dto\Secret\ProfileSecretDto;
use Lava\Api\Exceptions\BaseException;
use Lava\Api\Exceptions\Course\CourseException;
use Lava\Api\Exceptions\H2h\H2hException;
use Lava\Api\Exceptions\Invoice\InvoiceException;
use Lava\Api\Exceptions\Payoff\CheckWalletException;
use Lava\Api\Exceptions\Payoff\ErrorGetPayoffTariffException;
use Lava\Api\Exceptions\Payoff\PayoffException;
use Lava\Api\Exceptions\Payoff\PayoffServiceException;
use Lava\Api\Exceptions\Shop\ShopException;
use Lava\Api\Http\Client\Client;
use Lava\Api\Http\Client\ClientCheckSignatureWebhook;
use Lava\Api\Http\Client\ClientGenerateSignature;
use Lava\Api\Http\H2h\CreateH2hInvoice;
use Lava\Api\Http\H2h\CreateH2HSbp;
use Lava\Api\Http\Invoices\CreateInvoice;
use Lava\Api\Http\Invoices\GetAvailibleTariffsDto;
use Lava\Api\Http\Invoices\GetStatusInvoice;
use Lava\Api\Http\Payoffs\CheckWalletDto;
use Lava\Api\Http\Payoffs\CreatePayoff;
use Lava\Api\Http\Payoffs\GetStatusPayoff;
use Lava\Api\Http\Payoffs\TariffDto;
use Lava\Api\Http\Profile\GetProfileBalance;
use Lava\Api\Http\Refund\CreateRefund;
use Lava\Api\Http\Refund\GetRefundStatus;
use Lava\Api\Http\Shop\GetShopBalance;
use LogicException;

class LavaFacade implements LavaFacadeContract
{

    /**
     * @var string
     */
    private string $shopId;
    /**
     * @var ClientContract
     */
    private ClientContract $client;
    /**
     * @var ClientGenerateSignatureContract
     */
    private ClientGenerateSignatureContract $clientGenerateSign;
    /**
     * @var ClientCheckSignatureWebhookContract
     */
    private ClientCheckSignatureWebhookContract $clientCheckWebhook;

    private ?ProfileSecretDto $profileSecretData;

    /**
     * @param string $secretKey
     * @param string $shopId
     * @param string|null $additionalKey
     * @param ClientContract|null $client
     * @param ClientGenerateSignatureContract|null $clientGenerateSign
     * @param ClientCheckSignatureWebhookContract|null $clientCheckWebhook
     * @param ProfileSecretDto|null $profileSecretData
     */
    public function __construct(
        string                               $secretKey,
        string                               $shopId,
        string                               $additionalKey = null,
        ?ClientContract                      $client = null,
        ?ClientGenerateSignatureContract     $clientGenerateSign = null,
        ?ClientCheckSignatureWebhookContract $clientCheckWebhook = null,
        ?ProfileSecretDto                    $profileSecretData = null
    )
    {
        $this->shopId = $shopId;
        $this->client = $client ?? new Client();
        $this->clientGenerateSign = $clientGenerateSign ?? new ClientGenerateSignature($secretKey);
        $this->clientCheckWebhook = $clientCheckWebhook ?? new ClientCheckSignatureWebhook($additionalKey);

        $this->profileSecretData = $profileSecretData;
    }

    /**
     * @param $requestData
     *
     * @return void
     */
    private function clearData(&$requestData): void
    {
        foreach ($requestData as $key => $value) {
            if (is_null($value)) {
                unset($requestData[$key]);
            }
        }
    }

    /**
     * @throws JsonException
     */
    private function setSignature(array &$requestData, string $secretKey): void
    {
        $this->clearData($requestData);

        $clientGenerateSignature = new ClientGenerateSignature($secretKey);

        $requestData['signature'] = $clientGenerateSignature->generateSignature($requestData);
    }

    /**
     * @param CreateInvoiceDto $invoice
     * @return CreatedInvoiceDto
     * @throws JsonException
     * @throws BaseException|InvoiceException
     */
    public function createInvoice(CreateInvoiceDto $invoice): CreatedInvoiceDto
    {
        $createInvoice = new CreateInvoice();
        $requestData = $createInvoice->toArray($invoice, $this->shopId);
        $this->clearData($requestData);
        $requestData['signature'] = $this->clientGenerateSign->generateSignature($requestData);
        $response = $this->client->createInvoice($requestData);
        return $createInvoice->toDto($response);
    }

    /**
     * @param GetStatusInvoiceDto $statusInvoice
     *
     * @return StatusInvoiceDto
     * @throws BaseException
     * @throws JsonException
     * @throws InvoiceException
     */
    public function checkStatusInvoice(GetStatusInvoiceDto $statusInvoice): StatusInvoiceDto
    {
        $checkStatusInvoice = new GetStatusInvoice();
        $requestData = $checkStatusInvoice->toArray($statusInvoice, $this->shopId);
        $this->clearData($requestData);
        $requestData['signature'] = $this->clientGenerateSign->generateSignature($requestData);
        $response = $this->client->getInvoiceStatus($requestData);
        return $checkStatusInvoice->toDto($response);
    }

    /**
     * @param CreateRefundDto $refundDto
     *
     * @return CreatedRefundDto
     * @throws JsonException
     * @throws Exception
     */
    public function createRefund(CreateRefundDto $refundDto): CreatedRefundDto
    {
        $createRefund = new CreateRefund();
        $requestData = $createRefund->toArray($refundDto, $this->shopId);
        $this->clearData($requestData);
        $requestData['signature'] = $this->clientGenerateSign->generateSignature($requestData);
        $response = $this->client->createRefund($requestData);
        return $createRefund->toDto($response);
    }

    /**
     * @param GetStatusRefundDto $refundDto
     *
     * @return StatusRefundDto
     * @throws JsonException
     * @throws Exception
     */
    public function checkStatusRefund(GetStatusRefundDto $refundDto): StatusRefundDto
    {
        $checkStatusRefund = new GetRefundStatus();
        $requestData = $checkStatusRefund->toArray($refundDto, $this->shopId);
        $this->clearData($requestData);
        $requestData['signature'] = $this->clientGenerateSign->generateSignature($requestData);
        $response = $this->client->getRefundStatus($requestData);
        return $checkStatusRefund->responseToDto($response);
    }

    /**
     * @return ShopBalanceDto
     * @throws JsonException
     * @throws ShopException|BaseException
     * @deprecated This method will be removed. Use getProfileBalance() instead.
     * @see self::getProfileBalance()
     */
    public function getShopBalance(): ShopBalanceDto
    {
        $getShopBalance = new GetShopBalance();
        $requestData = $getShopBalance->toArray($this->shopId);
        $this->clearData($requestData);
        $requestData['signature'] = $this->clientGenerateSign->generateSignature($requestData);
        $response = $this->client->getShopBalance($requestData);
        return $getShopBalance->toDto($response);
    }

    /**
     * @param CreateH2hInvoiceDto $h2HInvoiceDto
     *
     * @return CreatedH2hInvoiceDto
     * @throws BaseException
     * @throws JsonException
     * @throws H2hException
     */
    public function createH2hInvoice(CreateH2hInvoiceDto $h2HInvoiceDto): CreatedH2hInvoiceDto
    {

        $getStatus = new CreateH2hInvoice();
        $requestData = $getStatus->toArray($h2HInvoiceDto, $this->shopId);
        $this->clearData($requestData);
        $requestData['signature'] = $this->clientGenerateSign->generateSignature($requestData);
        $response = $this->client->createH2hInvoice($requestData);
        return $getStatus->toDto($response);
    }

    /**
     * @param CreateSBPH2HDto $h2HInvoiceDto
     *
     * @return CreatedSBPH2hDto
     * @throws BaseException
     * @throws H2hException
     * @throws JsonException
     */
    public function createH2HSpbInvoice(CreateSBPH2HDto $h2HInvoiceDto): CreatedSBPH2hDto
    {
        $getStatus = new CreateH2HSbp();
        $requestData = $getStatus->toArray($h2HInvoiceDto, $this->shopId);
        $this->clearData($requestData);
        $requestData['signature'] = $this->clientGenerateSign->generateSignature($requestData);
        $response = $this->client->createH2hSbp($requestData);
        return $getStatus->toDto($response);
    }

    /**
     * @param CreatePayoffDto $payoff
     *
     * @return CreatedPayoffDto
     * @throws BaseException
     * @throws JsonException
     * @throws PayoffException
     * @throws PayoffServiceException
     */
    public function createPayoff(CreatePayoffDto $payoff): CreatedPayoffDto
    {
        if (is_null($this->profileSecretData)) {
            throw new LogicException('Profile Secret Data is null');
        }

        $createPayoff = new CreatePayoff();
        $requestData = $createPayoff->toArray($payoff, $this->profileSecretData->getProfileId());
        $this->setSignature($requestData, $this->profileSecretData->getSecretKey());
        $response = $this->client->createPayoff($requestData);
        return $createPayoff->toDto($response);
    }

    /**
     * @param GetPayoffStatusDto $payoffStatus
     *
     * @return StatusPayoffDto
     * @throws BaseException
     * @throws JsonException
     * @throws PayoffException
     */
    public function getStatusPayoff(GetPayoffStatusDto $payoffStatus): StatusPayoffDto
    {
        if (is_null($this->profileSecretData)) {
            throw new LogicException('Profile Secret Data is null');
        }

        $getStatus = new GetStatusPayoff();
        $requestData = $getStatus->toArray($payoffStatus, $this->profileSecretData->getProfileId());
        $this->setSignature($requestData, $this->profileSecretData->getSecretKey());
        $response = $this->client->getPayoffStatus($requestData);
        return $getStatus->toDto($response);
    }

    /**
     * @throws JsonException
     * @throws BaseException
     * @throws ErrorGetPayoffTariffException
     */
    public function getPayoffTariffs(): array
    {
        if (is_null($this->profileSecretData)) {
            throw new LogicException('Profile Secret Data is null');
        }

        $tariffs = new TariffDto();
        $requestData = ['profileId' => $this->profileSecretData->getProfileId()];
        $this->setSignature($requestData, $this->profileSecretData->getSecretKey());
        $response = $this->client->getPayoffTariffs($requestData);
        return $tariffs->toDto($response);
    }

    /**
     * @param CheckWalletRequestDto $checkWallet
     *
     * @return CheckWalletResponseDto
     * @throws BaseException
     * @throws CheckWalletException
     * @throws JsonException
     */
    public function checkWallet(CheckWalletRequestDto $checkWallet): CheckWalletResponseDto
    {
        if (is_null($this->profileSecretData)) {
            throw new LogicException('Profile Secret Data is null');
        }

        $walletStatus = new CheckWalletDto();
        $requestData = $walletStatus->toArray($checkWallet, $this->profileSecretData->getProfileId());
        $this->setSignature($requestData, $this->profileSecretData->getSecretKey());
        $response = $this->client->checkWallet($requestData);
        return $walletStatus->toDto($response);
    }

    /**
     * @param string $webhookResponse
     * @param string $signature
     *
     * @return bool
     * @throws JsonException
     */
    public function checkSignWebhook(string $webhookResponse, string $signature): bool
    {
        return $this->clientCheckWebhook->checkSignWebhook($webhookResponse, $signature);
    }

    /**
     * @throws JsonException
     */
    public function checkPayoffSignature(string $webhookResponse, string $signature): bool
    {
        if (is_null($this->profileSecretData)) {
            throw new LogicException('Profile Secret Data is null');
        }

        if (is_null($this->profileSecretData->getAdditionalKey())) {
            throw new LogicException('Payoff Additional Key is null');
        }

        $clientCheckWebhook = new ClientCheckSignatureWebhook($this->profileSecretData->getAdditionalKey());

        return $clientCheckWebhook->checkSignWebhook($webhookResponse, $signature);
    }

    /**
     * @return array
     * @throws BaseException
     * @throws InvoiceException
     * @throws JsonException
     */
    public function getAvailibleTariffs(): array
    {
        $availibleTariffs = new GetAvailibleTariffsDto();
        $requestData['shopId'] = $this->shopId;
        $requestData['signature'] = $this->clientGenerateSign->generateSignature($requestData);
        $response = $this->client->getAvailibleTariffs($requestData);
        return $availibleTariffs->toDto($response);
    }

    /**
     * @throws JsonException
     * @throws BaseException
     */
    public function getProfileBalance(): ProfileBalanceDto
    {
        if (is_null($this->profileSecretData)) {
            throw new LogicException('Profile Secret Data is null');
        }

        $getProfileBalance = new GetProfileBalance();
        $requestData = $getProfileBalance->toArray($this->profileSecretData->getProfileId());
        $this->setSignature($requestData, $this->profileSecretData->getSecretKey());
        $response = $this->client->getProfileBalance($requestData);
        return $getProfileBalance->toDto($response);
    }

    /**
     * @throws JsonException
     * @throws BaseException
     */
    public function getPaymentCourseList(): array
    {
        $requestData['shopId'] = $this->shopId;
        $requestData['signature'] = $this->clientGenerateSign->generateSignature($requestData);

        $list = $this->client->getPaymentCourseList($requestData);

        if (!isset($list['data']) && !is_array($list['data'])) {
            throw new CourseException();
        }

        return array_map(fn(array $v) => $this->parseCourse($v), $list['data']);
    }


    public function getPayoffCourseList(): array
    {
        $requestData['shopId'] = $this->shopId;
        $requestData['signature'] = $this->clientGenerateSign->generateSignature($requestData);

        $list = $this->client->getPayoffCourseList($requestData);

        if (!isset($list['data']) && !is_array($list['data'])) {
            throw new CourseException();
        }

        return array_map(fn(array $v) => $this->parseCourse($v), $list['data']);
    }

    private function parseCourse(array $value): CourseDto
    {
        $requiredFields = [
            'currency' => [
                'label',
                'symbol',
                'value',
            ],
            'value' => [],
        ];

        foreach ($requiredFields as $key => $fields) {
            if (!array_key_exists($key, $value)) {
                throw new InvalidArgumentException("Field '$key' is required.");
            }

            foreach ($fields as $field) {
                if (!array_key_exists($field, $value[$key])) {
                    throw new InvalidArgumentException("Field '$key.$field' is required.");
                }
            }
        }

        $currency = new CurrencyDto(
            $value['currency']['label'],
            $value['currency']['symbol'],
            $value['currency']['value'],
        );

        return new CourseDto(
            $currency,
            $value['value']
        );
    }
}