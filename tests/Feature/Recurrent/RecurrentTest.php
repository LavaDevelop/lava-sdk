<?php

namespace Feature\Recurrent;

use JsonException;
use Lava\Api\Dto\Request\Recurrent\CreateConsumerDto;
use Lava\Api\Dto\Request\Recurrent\CreateSubscriptionDto;
use Lava\Api\Dto\Request\Recurrent\GetSubscriptionStatusDto;
use Lava\Api\Dto\Request\Recurrent\OffsetNextPayTimeDto;
use Lava\Api\Dto\Request\Recurrent\UnsubscribeDto;
use Lava\Api\Dto\Response\Recurrent\ConsumerDto;
use Lava\Api\Dto\Response\Recurrent\CreatedSubscriptionDto;
use Lava\Api\Dto\Response\Recurrent\OffsetNextPayTimeResponseDto;
use Lava\Api\Dto\Response\Recurrent\ProductDto;
use Lava\Api\Dto\Response\Recurrent\SubscriptionStatusDto;
use Lava\Api\Dto\Response\Recurrent\UnsubscribedSubscriptionDto;
use Lava\Api\Exceptions\Recurrent\RecurrentException;
use Lava\Api\Http\Client\Client;
use Lava\Api\Http\LavaFacade;
use Lava\Api\Http\Recurrent\Recurrent;
use PHPUnit\Framework\TestCase;
use Test\Lava\Api\Mocks\Client\ClientErrorResponseMock;
use Test\Lava\Api\Mocks\Client\ClientSuccessResponseMock;
use Test\Lava\Api\Mocks\Client\RecurrentProductionResponseMock;

class RecurrentTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function testRecurrentSubscriptionMethods(): void
    {
        $facade = new LavaFacade('secret-key', 'shop-id', null, new ClientSuccessResponseMock());

        $products = $facade->getRecurrentProducts();
        $consumer = $facade->createRecurrentConsumer(new CreateConsumerDto('test@example.com', 'consumer-id', '89809099090', 'Test'));
        $subscription = $facade->createSubscription(new CreateSubscriptionDto('product-id', 'consumer-id', 'order-id'));
        $status = $facade->getSubscriptionStatus(new GetSubscriptionStatusDto('subscription-id'));
        $offset = $facade->offsetSubscriptionNextPayTime(new OffsetNextPayTimeDto(30, 'subscription-id'));
        $unsubscribed = $facade->unsubscribe(new UnsubscribeDto(null, 'order-id'));

        $this->assertCount(1, $products);
        $this->assertInstanceOf(ProductDto::class, $products[0]);
        $this->assertSame('one_month', $products[0]->getPeriod());
        $this->assertInstanceOf(ConsumerDto::class, $consumer);
        $this->assertSame('consumer-id', $consumer->getConsumerId());
        $this->assertInstanceOf(CreatedSubscriptionDto::class, $subscription);
        $this->assertSame(100.0, $subscription->getAmount());
        $this->assertInstanceOf(SubscriptionStatusDto::class, $status);
        $this->assertSame('activated', $status->getStatus());
        $this->assertInstanceOf(OffsetNextPayTimeResponseDto::class, $offset);
        $this->assertSame('2023-09-26 11:00:30', $offset->getNextPayTime());
        $this->assertInstanceOf(UnsubscribedSubscriptionDto::class, $unsubscribed);
        $this->assertTrue($unsubscribed->isUnsubscribed());
    }

    public function testSubscriptionIdentifierIsRequired(): void
    {
        $client = new Client();

        $this->expectException(RecurrentException::class);
        $this->expectExceptionMessage('subscriptionId or orderId required');

        $client->getSubscriptionStatus([]);
    }

    public function testOffsetDaysAreSerializedAsString(): void
    {
        $request = new Recurrent();
        $data = $request->offsetToArray(new OffsetNextPayTimeDto(30, 'subscription-id'), 'shop-id');

        $this->assertSame('30', $data['days']);
    }

    public function testProductionAnonymizedRequestResponseContract(): void
    {
        $client = new RecurrentProductionResponseMock();
        $facade = new LavaFacade('anonymized-secret', '00000000-0000-4000-8000-000000000001', null, $client);

        $products = $facade->getRecurrentProducts();
        $consumer = $facade->createRecurrentConsumer(new CreateConsumerDto(
            'customer@example.test',
            'prod-test-consumer-0001',
            '+79990000000',
            'Anonymized Customer'
        ));
        $subscription = $facade->createSubscription(new CreateSubscriptionDto(
            $products[0]->getId(),
            $consumer->getConsumerId(),
            'prod-test-order-0001'
        ));
        $status = $facade->getSubscriptionStatus(new GetSubscriptionStatusDto($subscription->getSubscriptionId()));
        $offset = $facade->offsetSubscriptionNextPayTime(new OffsetNextPayTimeDto(7, $subscription->getSubscriptionId()));
        $unsubscribed = $facade->unsubscribe(new UnsubscribeDto($subscription->getSubscriptionId()));

        $this->assertSame('created', $status->getStatus());
        $this->assertSame('2030-01-08 12:00:00', $offset->getNextPayTime());
        $this->assertTrue($unsubscribed->isUnsubscribed());
        $this->assertSame('7', $client->requests['offsetSubscriptionNextPayTime']['days']);

        foreach ($client->requests as $request) {
            $this->assertSame('00000000-0000-4000-8000-000000000001', $request['shopId']);
            $this->assertMatchesRegularExpression('/^[a-f0-9]{64}$/', $request['signature']);
        }
    }

    /**
     * @throws JsonException
     */
    public function testRecurrentApiErrorIsPropagated(): void
    {
        $facade = new LavaFacade('secret-key', 'shop-id', null, new ClientErrorResponseMock());

        $this->expectException(RecurrentException::class);
        $this->expectExceptionMessage('Subscription not found');

        $facade->unsubscribe(new UnsubscribeDto('subscription-id'));
    }
}
