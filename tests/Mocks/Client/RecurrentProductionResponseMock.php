<?php

namespace Test\Lava\Api\Mocks\Client;

class RecurrentProductionResponseMock extends ClientSuccessResponseMock
{
    public array $requests = [];

    public function getRecurrentProducts(array $data): array
    {
        $this->requests['getRecurrentProducts'] = $data;

        return [
            'data' => [[
                'id' => '11111111-1111-4111-8111-111111111111',
                'name' => '[ANONYMIZED_PRODUCT]',
                'price' => 100.0,
                'period' => 'one_month',
                'periodDays' => 30,
                'freeDays' => 0,
                'description' => '[ANONYMIZED_DESCRIPTION]',
                'shopId' => '00000000-0000-4000-8000-000000000001',
                'isActive' => true,
                'activeCount' => 0,
                'inactiveCount' => 0,
                'subscribersCount' => 0,
            ]],
            'status' => 200,
            'status_check' => true,
        ];
    }

    public function createRecurrentConsumer(array $data): array
    {
        $this->requests['createRecurrentConsumer'] = $data;

        return [
            'data' => [
                'phone' => $data['phone'],
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
        $this->requests['createSubscription'] = $data;

        return [
            'data' => [
                'subscriptionId' => '22222222-2222-4222-8222-222222222222',
                'amount' => 100.0,
                'expired' => '2030-01-01 12:00:00',
                'url' => 'https://pay.lava.ru/invoice/[ANONYMIZED]',
                'comment' => '[ANONYMIZED_COMMENT]',
            ],
            'status' => 200,
            'status_check' => true,
        ];
    }

    public function getSubscriptionStatus(array $data): array
    {
        $this->requests['getSubscriptionStatus'] = $data;

        return [
            'data' => [
                'subscriptionId' => $data['subscriptionId'],
                'orderId' => 'prod-test-order-0001',
                'consumerId' => 'prod-test-consumer-0001',
                'shopId' => $data['shopId'],
                'productId' => '11111111-1111-4111-8111-111111111111',
                'status' => 'created',
                'amount' => 100.0,
            ],
            'status' => 200,
            'status_check' => true,
        ];
    }

    public function offsetSubscriptionNextPayTime(array $data): array
    {
        $this->requests['offsetSubscriptionNextPayTime'] = $data;

        return [
            'data' => ['next_pay_time' => '2030-01-08 12:00:00'],
            'status' => 200,
            'status_check' => true,
        ];
    }

    public function unsubscribe(array $data): array
    {
        $this->requests['unsubscribe'] = $data;

        return [
            'data' => ['unsubscribed' => true],
            'status' => 200,
            'status_check' => true,
        ];
    }
}
