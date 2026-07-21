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

Для методов профиля и вывода (`createPayoff`, `getStatusPayoff`, `getPayoffTariffs`, `checkWallet`, `getProfileBalance`,
`checkPayoffSignature`) нужно передать `ProfileSecretDto`.

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

### Рекуррентные платежи

Рекуррентные методы используют те же `shop_secret_key` и `shop_id`, что и методы инвойсов. Подпись запроса и `shopId`
формируются SDK автоматически.

#### Список продуктов подписки `getRecurrentProducts`

```php
$products = $facade->getRecurrentProducts();

foreach ($products as $product) {
    echo $product->getName();
    echo $product->getPrice();
}
```

Возвращает массив объектов `ProductDto`. У объекта доступны, в частности, методы `getId()`, `getName()`, `getPrice()`,
`getPeriod()`, `getPeriodDays()`, `getFreeDays()`, `getDescription()`, `isActive()` и `getSubscribersCount()`.

#### Создание подписчика `createRecurrentConsumer`

```php
use Lava\Api\Dto\Request\Recurrent\CreateConsumerDto;

$consumer = new CreateConsumerDto(
    'customer@example.com',
    'customer-1001',
    '+79990000000', // optional
    'Иван Иванов' // optional
);

$response = $facade->createRecurrentConsumer($consumer);
```

Возвращает `ConsumerDto` с методами `getConsumerId()`, `getEmail()`, `getPhone()` и `getShopId()`.

#### Оформление подписки `createSubscription`

Сначала создайте подписчика, затем передайте его `consumerId` и идентификатор продукта из `getRecurrentProducts()`.

```php
use Lava\Api\Dto\Request\Recurrent\CreateSubscriptionDto;

$subscription = new CreateSubscriptionDto(
    'product-uuid',
    'customer-1001',
    'subscription-order-1001'
);

$response = $facade->createSubscription($subscription);
$paymentUrl = $response->getUrl();
```

Возвращает `CreatedSubscriptionDto`. Методы `getSubscriptionId()`, `getAmount()`, `getExpired()`, `getUrl()` и
`getComment()` содержат данные созданной подписки и ссылку на первоначальную оплату.

#### Статус подписки `getSubscriptionStatus`

Идентифицируйте подписку по `subscriptionId` или по вашему `orderId`.

```php
use Lava\Api\Dto\Request\Recurrent\GetSubscriptionStatusDto;

$status = $facade->getSubscriptionStatus(
    new GetSubscriptionStatusDto('subscription-uuid')
);

// Или поиск по ID заказа в вашей системе:
$status = $facade->getSubscriptionStatus(
    new GetSubscriptionStatusDto(null, 'subscription-order-1001')
);
```

Возвращает `SubscriptionStatusDto`. Основные методы: `getStatus()`, `getSubscriptionId()`, `getOrderId()`,
`getConsumerId()`, `getProductId()`, `getAmount()`, `getLastPayTime()`, `getNextPayTime()` и `getDeactivatedReason()`.

#### Перенос следующего платежа `offsetSubscriptionNextPayTime`

```php
use Lava\Api\Dto\Request\Recurrent\OffsetNextPayTimeDto;

$response = $facade->offsetSubscriptionNextPayTime(
    new OffsetNextPayTimeDto(7, 'subscription-uuid')
);

$nextPayTime = $response->getNextPayTime();
```

Первый аргумент — число дней переноса. Подписку можно указать также через `orderId`:
`new OffsetNextPayTimeDto(7, null, 'subscription-order-1001')`. Метод возвращает `OffsetNextPayTimeResponseDto`.

#### Отмена подписки `unsubscribe`

```php
use Lava\Api\Dto\Request\Recurrent\UnsubscribeDto;

$response = $facade->unsubscribe(
    new UnsubscribeDto(null, 'subscription-order-1001')
);

if ($response->isUnsubscribed()) {
    // Подписка отменена
}
```

Возвращает `UnsubscribedSubscriptionDto`. Для `getSubscriptionStatus`, `offsetSubscriptionNextPayTime` и `unsubscribe`
обязателен хотя бы один идентификатор: `subscriptionId` или `orderId`; иначе выбрасывается `RecurrentException` с кодом
`422`.

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

Этот метод используется и для webhook-уведомлений о рекуррентных подписках. В payload рекуррентного webhook поле `type`
имеет значение `4`; статус подписки передаётся в поле `status` (`activated`, `deactivated` или `suspended`).

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

При ошибках API методы выбрасывают исключения (например, `InvoiceException`, `PayoffException`, `RefundException`,
`RecurrentException`, `BaseException` и другие). Рекомендуется оборачивать вызовы фасада в `try/catch` и логировать
сообщение и код ошибки.
