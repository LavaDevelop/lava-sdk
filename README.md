# Lava SDK

![compatible](https://img.shields.io/badge/php-%5E7.4-green?style=plastic)

SDK для работы с API Lava через фасад `Lava\Api\Http\LavaFacade`.

## Установка

```bash
composer require lava-payment/lava
```

## Быстрый старт

### Инициализация (только shop-методы)

```php
use Lava\Api\Http\LavaFacade;

$facade = new LavaFacade(
    'shop_secret_key',
    'shop_id',
    'shop_webhook_additional_key' // optional
);
```

### Инициализация для profile/payoff методов

Для методов профиля и вывода (`createPayoff`, `getStatusPayoff`, `getPayoffTariffs`, `checkWallet`, `getProfileBalance`, `checkPayoffSignature`) нужно передать `ProfileSecretDto`.

```php
use Lava\Api\Dto\Secret\ProfileSecretDto;
use Lava\Api\Http\LavaFacade;

$profileSecret = new ProfileSecretDto(
    'profile_id',
    'profile_secret_key',
    'profile_additional_key' // optional, нужен для checkPayoffSignature
);

$facade = new LavaFacade(
    'shop_secret_key',
    'shop_id',
    'shop_webhook_additional_key',
    null,
    null,
    null,
    $profileSecret
);
```

## Методы фасада

### Инвойсы

#### Создание платежа `createInvoice`

```php
use Lava\Api\Dto\Request\Invoice\CreateInvoiceDto;

$dto = new CreateInvoiceDto(
    '300.09',
    'order-1001',
    'https://example.com/hook',
    'https://example.com/success',
    'https://example.com/fail',
    300,
    '{"productId":39}',
    'Pay product'
);

$response = $facade->createInvoice($dto);
```

Возвращает `CreatedInvoiceDto`.

#### Статус платежа `checkStatusInvoice`

```php
use Lava\Api\Dto\Request\Invoice\GetStatusInvoiceDto;

$dto = new GetStatusInvoiceDto(null, $invoiceId); // по invoiceId
$response = $facade->checkStatusInvoice($dto);
```

Возвращает `StatusInvoiceDto`.

#### Доступные тарифы `getAvailibleTariffs`

```php
$tariffs = $facade->getAvailibleTariffs();
```

Возвращает массив объектов `AvailibleTariffDto`.

### Возвраты

#### Создание возврата `createRefund`

```php
use Lava\Api\Dto\Request\Refund\CreateRefundDto;

$dto = new CreateRefundDto(
    'invoice-id',
    null,
    100.00
);

$response = $facade->createRefund($dto);
```

Возвращает `CreatedRefundDto`.

#### Статус возврата `checkStatusRefund`

```php
use Lava\Api\Dto\Request\Refund\GetStatusRefundDto;

$dto = new GetStatusRefundDto($refundId);
$response = $facade->checkStatusRefund($dto);
```

Возвращает `StatusRefundDto`.

### Баланс

#### Баланс профиля `getProfileBalance`

```php
$profileBalance = $facade->getProfileBalance();
```

Возвращает `ProfileBalanceDto`.

#### Баланс магазина `getShopBalance` (deprecated)

```php
$shopBalance = $facade->getShopBalance();
```

Метод помечен как deprecated. Используйте `getProfileBalance()`.

### Выводы (Payoff)

#### Создание вывода `createPayoff`

```php
use Lava\Api\Dto\Request\Payoff\CreatePayoffDto;

$dto = new CreatePayoffDto(
    'withdraw-order-1',
    10.00,
    'lava_payoff'
);

$response = $facade->createPayoff($dto);
```

Возвращает `CreatedPayoffDto`.

#### Статус вывода `getStatusPayoff`

```php
use Lava\Api\Dto\Request\Payoff\GetPayoffStatusDto;

$dto = new GetPayoffStatusDto(null, $payoffId);
$response = $facade->getStatusPayoff($dto);
```

Возвращает `StatusPayoffDto`.

#### Тарифы вывода `getPayoffTariffs`

```php
$tariffs = $facade->getPayoffTariffs();
```

Возвращает массив DTO тарифов вывода.

#### Проверка кошелька `checkWallet`

```php
use Lava\Api\Dto\Request\Payoff\CheckWalletRequestDto;

$dto = new CheckWalletRequestDto('lava_payoff', 'wallet_value');
$response = $facade->checkWallet($dto);
```

Возвращает `CheckWalletResponseDto`.

### Вебхуки и подписи

#### Проверка подписи shop webhook `checkSignWebhook`

```php
$data = file_get_contents('php://input');
$headers = getallheaders();

if (!isset($headers['Authorization'])) {
    throw new Exception('Authorization header is required');
}

$isValid = $facade->checkSignWebhook($data, $headers['Authorization']);
```

#### Проверка подписи payoff webhook `checkPayoffSignature`

```php
$data = file_get_contents('php://input');
$headers = getallheaders();

if (!isset($headers['Authorization'])) {
    throw new Exception('Authorization header is required');
}

$isValid = $facade->checkPayoffSignature($data, $headers['Authorization']);
```

## Исключения

При ошибках API методы выбрасывают исключения (например, `InvoiceException`, `PayoffException`, `RefundException`, `BaseException` и другие). Рекомендуется оборачивать вызовы фасада в `try/catch` и логировать сообщение и код ошибки.

