# Lava sdk #

______

### ![compatible](https://img.shields.io/badge/php-%5E7.4-green?style=plastic) ###

## Установка ##

_____

```
composer require lava-payment/lava
```

## Использование ##

___

Для работы нужно получить секретный ключ магазина.

### Инициализация  ###

____

```php 
use Lava\Api\Http\LavaFacade;

$facade = new LavaFacade('your secret key', 'shopId', 'your additional key');
```

### Получение баланса магазина ###

___

```php 
$response = $facade->getShopBalance();
```

При успешном запросе вы получаете объект, который содержит balance и freezeBalance.

При не успешном запросе возникает исключение с сообщением и кодом ответа.

### Создание платежа ###

___

Метод createInvoice на вход принимает объект createInvoiceDto, который в свою очередь
имеет 2 обязательных параметра sum и orderId.

```php
use Lava\Api\Dto\Request\Invoice\CreateInvoiceDto;

$createInvoiceDto = new CreateInvoiceDto(
    300.09,
    'orderId', 
    'https://exaple.com', 
    'https://exaple.com', 
    'https://exaple.com', 
    300, 
    '{productId: 39}', 
    'Pay product'
);

$response = $facade->createInvoice($createInvoiceDto);
```

При успешном запросе вы получаете объект, который содержит invoiceId, amount, expired, status, shopId, url.

При не успешном запросе возникает исключение с сообщением и кодом ответа.

### Проверка статуса платежа ###

___

Метод checkStatusInvoice на вход принимает объект GetStatusInvoiceDto, который принимает 2 параметра 1 из них
обязателен.

invoiceId - id который получили после создания платежа

orderId - id платежа в вашей системе

```php
use Lava\Api\Dto\Request\Invoice\GetStatusInvoiceDto;

$statusInvoice = new GetStatusInvoiceDto(null, $invoiceId); //проверка платежа по invoiceId

$response = $facade->checkStatusInvoice($statusInvoice);
```

При успешном запросе вы получаете объект StatusInvoiceDto.

При не успешном запросе возникает исключение с сообщением и кодом ответа.

### Создание вывода ###

___

Метод createPayoff на вход принимает объект CreatePayoffDto, который принимает 3 обязательных параметра:

orderId - id вывода в вашей системе, amount - сумма вывода и service - вывод на какой сервис будет произведен.

```php
use Lava\Api\Dto\Request\Payoff\CreatePayoffDto;

$payoffCreate = new CreatePayoffDto('1234', 10, 'lava_payoff');

$response = $facade->createPayoff($payoffCreate);
```

При успешном запросе вы получаете объект CreatedPayoffDto который содержит 2 параметра:

refundId - id вывода в нашей системе и status - текущий статус вывода.

При не успешном запросе возникает исключение с сообщением и кодом ответа.

### Информация о выводе ###

___

Метод getStatusPayoff на вход принимает объект GetPayoffStatusDto, который принимает 2 параметра 1 из них обязателен.

payoffId - id который получили после создания вывода

orderId - id платежа в вашей системе

```php
use Lava\Api\Dto\Request\Payoff\GetPayoffStatusDto;

$payoffStatus = new GetPayoffStatusDto(null, $payoffId);

$response = $facade->getStatusPayoff($payoffStatus);
```

При успешном запросе вы получаете объект StatusPayoffDto который содержит всю информацию о выводе.

При не успешном запросе возникает исключение с сообщением и кодом ответа.

### Создание возврата ###

___

Метод createRefund на вход принимает объект CreateRefundDto, который принимает 1 обязательный параметр
invoiceId - id платежа в нашей системе. Для частичного возврата вместе с invoiceId передается сумма возврата.

```php
use Lava\Api\Dto\Request\Refund\CreateRefundDto;

$refundCreate = new CreateRefundDto('5b7d4464-d375-41d4-95b1-bb9786fbbac7', null, 100);

$response = $facade->createRefund($refundCreate);
```

При успешном запросе вы получаете объект CreatedRefundDto.

При не успешном запросе возникает исключение с сообщением и кодом ответа.

### Информация о возврате ###

___

Метод checkStatusRefund на вход принимает объект GetStatusRefundDto, который принимает 1 обязательный параметр
refundId - id возврата в нашей системе.

```php
use Lava\Api\Dto\Request\Refund\GetStatusRefundDto;

$refundGetStatus = new GetStatusRefundDto($refundId);

$response = $facade->checkStatusRefund($refundGetStatus);
```

При успешном запросе вы получаете объект StatusRefundDto.

При не успешном запросе возникает исключение с сообщением и кодом ответа.

### Создание инвойса H2H ###

___

Метод createH2hInvoice на вход принимает объект CreateH2hInvoiceDto, который принимает 6 обязательных параметров
amount - cумма на которую выставляется счет,
orderId - id в вашей системе,
cvv - cvv карты,
month - месяц до которого действительна карта,
year - год до которого действительна карта,
cardNumber - номер карты

```php
use Lava\Api\Dto\Request\H2h\CreateH2hInvoiceDto;

$h2hCreate = new CreateH2hInvoiceDto(
        100,
        "orderId",
        701,
        11,
        30,
        '5536914283728079'
    );

$response = $facade->createH2hInvoice($h2hCreate);
```

При успешном запросе вы получаете объект CreatedH2hInvoiceDto.

При не успешном запросе возникает исключение с сообщением и кодом ответа.

### Создание инвойса H2H СБП ###

___


Метод createH2hInvoice на вход принимает объект CreateH2hInvoiceDto, который принимает 6 обязательных параметров
amount - cумма на которую выставляется счет,
orderId - id в вашей системе,
ip - ip пользователя

```php
use Lava\Api\Dto\Request\H2h\CreateSBPH2HDto;

$h2hCreate = new CreateSBPH2HDto(
        100,
        $orderId,
        '127.0.0.1'
    );

$response = $facade->createH2HSpbInvoice($h2hCreate);
```

При успешном запросе вы получаете объект CreatedSBPH2hDto.

При не успешном запросе возникает исключение с сообщением и кодом ответа.

### Проверка подписи веб хука ###

___

Метод checkSignWebhook принимает 2 параметра тело запроса в формате json и подпись с заголовка 'Authorization'.

```php

$data = file_get_contents('php://input');
$hookSignature = getallheaders();

if(!isset($hookSignature['Authorization'])) {
    throw new Exception();
}

$facade->checkSignWebhook($data, $hookSignature['Authorization']);
```
