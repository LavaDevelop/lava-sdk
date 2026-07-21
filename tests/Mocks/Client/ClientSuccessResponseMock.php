<?php

namespace Test\Lava\Api\Mocks\Client;

use Lava\Api\Contracts\Client\ClientContract;

class ClientSuccessResponseMock implements ClientContract
{

    /**
     * @param array $data
     * @return array
     */
    public function createRefund(array $data): array
    {
        return [
            'data' => [
                'status' => 'success',
                'refund_id' => '5b7d4464-d375-41d4-95b1-bb9786fbbac6',
                'amount' => 10.53,
                'service' => 'card',
                'label' => 'Банковская карта'
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function getRefundStatus(array $data): array
    {
        return [
            'data' => [
                'status' => 'success',
                'refund_id' => '5b7d4464-d375-41d4-95b1-bb9786fbbac6',
                'amount' => 10.53,
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function createInvoice(array $data): array
    {
        return [
            'data' => [
                'id' => '01fc840d-a0b1-43ca-b65d-ca713d8a1f95',
                'amount' => 300,
                'expired' => '2022-11-07 13:46:37',
                'status' => 0,
                'shop_id' => uniqid('', true),
                'url' => "https:\/\/pay.lava.ru\/invoice\/01fc840d-a0b1-43ca-b65d-ca713d8a1f95",
                'comment' => null,
                'merchantName' => 'name',
                'exclude_service' => null,
                'include_service' => null
            ],
            'status' => 200,
            'status_check' => true,
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function getInvoiceStatus(array $data): array
    {
        return [
            'data' => [
                'status' => 'created',
                'error_message' => null,
                'id' => '01fc840d-a0b1-43ca-b65d-ca713d8a1f95',
                'shop_id' => '4e48b574-48c4-4d35-a64d-6a0bb169d4fb',
                'amount' => 300,
                'expire' => '2022-11-07 13:46:37',
                'order_id' => '6368c5ed3e7521.67590325',
                'fail_url' => null,
                'success_url' => null,
                'hook_url' => null,
                'custom_fields' => null,
                'include_service' => null,
                'exclude_service' => null,
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function getShopBalance(array $data): array
    {
        return [
            'data' => [
                'balance' => 37500.08,
                'freeze_balance' => 375000.08
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function createPayoff(array $data): array
    {
        return [
            'data' => [
                'payoff_id' => 'cc3bcb98-5c10-4eeb-8aab-1da96e6575c2',
                'payoff_status' => 'created',
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function getPayoffStatus(array $data): array
    {
        return [
            'data' => [
                'id' => 'cc3bcb98-5c10-4eeb-8aab-1da96e6575c1',
                'orderId' => '636915c4707440',
                'status' => 'success',
                'wallet' => null,
                'service' => 'lava_payoff',
                'amountPay' => 10,
                'commission' => 0,
                'amountReceive' => 10,
                'tryCount' => 1,
                'errorMessage' => null
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function checkWallet(array $data): array
    {
        return [
            'data' => [
                'status' => true,
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    public function getPayoffTariffs(array $data): array
    {
        return [];
    }

    public function getAvailibleTariffs(array $data): array
    {
        return [
            'data' => [
                'percent' => 10,
                'user_percent' => 5,
                'shop_percent' => 5,
                'service_id' => 1,
                'service_name' => 'Банковская карта',
                'status' => 'p2p_card',
                'currency' => 'RUB',
                'min_amount' => 10,
                'max_amount' => 100000,
                'fix_commission' => 3,
                'discount_percent' => 0,
                'discount_from_amount' => 0,
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    public function getProfileBalance(array $data): array
    {
        return [
            'data' => [
                'freeze_balance' => 2000,
                'active_balance' => 8000,
                'balance' => 10000,
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    public function getPayoffCourseList(array $data): array
    {
        return [
            'data' => [
                [
                    'currency' => [
                        'symbol' => '₽',
                        'value' => 'RUB',
                        'label' => 'Российский рубль'
                    ],
                    'value' => 1
                ],
                [
                    'currency' => [
                        'symbol' => '₽',
                        'value' => 'RUB',
                        'label' => 'Российский рубль'
                    ],
                    'value' => 1
                ],
                [
                    'currency' => [
                        'symbol' => 'USDT',
                        'value' => 'USDT',
                        'label' => 'Tether USD'
                    ],
                    'value' => rand(90, 120)
                ],
                [
                    'currency' => [
                        'symbol' => 'BTC',
                        'value' => 'BTC',
                        'label' => 'Bitcoin'
                    ],
                    'value' => rand(40_000, 120_000)
                ],
                [
                    'currency' => [
                        'symbol' => 'ETH',
                        'value' => 'ETH',
                        'label' => 'Etherium'
                    ],
                    'value' => rand(1_000, 5_000)
                ]
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    public function getPaymentCourseList(array $data): array
    {
        return [
            'data' => [
                [
                    'currency' => [
                        'symbol' => '₽',
                        'value' => 'RUB',
                        'label' => 'Российский рубль'
                    ],
                    'value' => 1
                ],
                [
                    'currency' => [
                        'symbol' => '₽',
                        'value' => 'RUB',
                        'label' => 'Российский рубль'
                    ],
                    'value' => 1
                ],
                [
                    'currency' => [
                        'symbol' => 'USDT',
                        'value' => 'USDT',
                        'label' => 'Tether USD'
                    ],
                    'value' => rand(90, 120)
                ],
                [
                    'currency' => [
                        'symbol' => 'BTC',
                        'value' => 'BTC',
                        'label' => 'Bitcoin'
                    ],
                    'value' => rand(40_000, 120_000)
                ],
                [
                    'currency' => [
                        'symbol' => 'ETH',
                        'value' => 'ETH',
                        'label' => 'Etherium'
                    ],
                    'value' => rand(1_000, 5_000)
                ]
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    public function getRecurrentProducts(array $data): array
    {
        return [
            'data' => [[
                'id' => '3fa85f64-5717-4562-b3fc-2c963f66afa6',
                'name' => 'Product name #1',
                'price' => 100,
                'period' => 'one_month',
                'periodDays' => 30,
                'freeDays' => 0,
                'description' => 'Description text',
                'shopId' => 'shop-id',
                'isActive' => true,
                'activeCount' => 1,
                'inactiveCount' => 0,
                'subscribersCount' => 1,
            ]],
            'status' => 200,
            'status_check' => true,
        ];
    }

    public function createRecurrentConsumer(array $data): array
    {
        return [
            'data' => [
                'phone' => $data['phone'] ?? null,
                'email' => $data['email'],
                'consumerId' => $data['consumerId'],
                'shopId' => $data['shopId'],
            ],
            'status' => 200,
            'status_check' => true,
        ];
    }

    public function createSubscription(array $data): array
    {
        return [
            'data' => [
                'subscriptionId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6',
                'amount' => 100,
                'expired' => '2022-08-19 09:58:44',
                'url' => 'https://pay.lava.ru/invoice/test',
                'comment' => 'Оплата подписки',
            ],
            'status' => 200,
            'status_check' => true,
        ];
    }

    public function getSubscriptionStatus(array $data): array
    {
        return [
            'data' => [
                'subscriptionId' => $data['subscriptionId'] ?? '3fa85f64-5717-4562-b3fc-2c963f66afa6',
                'orderId' => $data['orderId'] ?? 'order-id',
                'consumerId' => 'consumer-id',
                'shopId' => $data['shopId'],
                'productId' => 'product-id',
                'status' => 'activated',
                'amount' => 100,
                'activation_time' => '2023-07-26 11:00:30',
                'last_pay_time' => '2023-07-27 01:00:30',
                'next_pay_time' => '2023-09-30 01:00:30',
                'payer_details' => '220020******4000',
            ],
            'status' => 200,
            'status_check' => true,
        ];
    }

    public function offsetSubscriptionNextPayTime(array $data): array
    {
        return [
            'data' => ['next_pay_time' => '2023-09-26 11:00:30'],
            'status' => 200,
            'status_check' => true,
        ];
    }

    public function unsubscribe(array $data): array
    {
        return [
            'data' => ['unsubscribed' => true],
            'status' => 200,
            'status_check' => true,
        ];
    }
}
