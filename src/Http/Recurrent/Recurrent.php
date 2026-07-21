<?php

namespace Lava\Api\Http\Recurrent;

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
use Lava\Api\Exceptions\BaseException;

class Recurrent
{
    /**
     * @throws BaseException
     */
    public function productListToDto(array $response): array
    {
        $data = $this->getData($response);
        $products = isset($data[0]) ? $data : [$data];

        return array_map(fn(array $product) => new ProductDto($product), $products);
    }

    public function consumerToArray(CreateConsumerDto $consumer, string $shopId): array
    {
        return [
            'phone' => $consumer->getPhone(),
            'email' => $consumer->getEmail(),
            'name' => $consumer->getName(),
            'consumerId' => $consumer->getConsumerId(),
            'shopId' => $shopId,
        ];
    }

    public function consumerToDto(array $response): ConsumerDto
    {
        return new ConsumerDto($this->getData($response));
    }

    public function subscriptionToArray(CreateSubscriptionDto $subscription, string $shopId): array
    {
        return [
            'productId' => $subscription->getProductId(),
            'consumerId' => $subscription->getConsumerId(),
            'orderId' => $subscription->getOrderId(),
            'shopId' => $shopId,
        ];
    }

    /**
     * @throws BaseException
     */
    public function subscriptionToDto(array $response): CreatedSubscriptionDto
    {
        return new CreatedSubscriptionDto($this->getData($response));
    }

    public function statusToArray(GetSubscriptionStatusDto $status, string $shopId): array
    {
        return [
            'subscriptionId' => $status->getSubscriptionId(),
            'orderId' => $status->getOrderId(),
            'shopId' => $shopId,
        ];
    }

    /**
     * @throws BaseException
     */
    public function statusToDto(array $response): SubscriptionStatusDto
    {
        return new SubscriptionStatusDto($this->getData($response));
    }

    public function offsetToArray(OffsetNextPayTimeDto $offset, string $shopId): array
    {
        return [
            'subscriptionId' => $offset->getSubscriptionId(),
            'orderId' => $offset->getOrderId(),
            'shopId' => $shopId,
            'days' => (string)$offset->getDays(),
        ];
    }

    /**
     * @throws BaseException
     */
    public function offsetToDto(array $response): OffsetNextPayTimeResponseDto
    {
        return new OffsetNextPayTimeResponseDto($this->getData($response));
    }

    public function unsubscribeToArray(UnsubscribeDto $unsubscribe, string $shopId): array
    {
        return [
            'subscriptionId' => $unsubscribe->getSubscriptionId(),
            'orderId' => $unsubscribe->getOrderId(),
            'shopId' => $shopId,
        ];
    }

    /**
     * @throws BaseException
     */
    public function unsubscribeToDto(array $response): UnsubscribedSubscriptionDto
    {
        return new UnsubscribedSubscriptionDto($this->getData($response));
    }

    /**
     * @throws BaseException
     */
    private function getData(array $response): array
    {
        if (empty($response['data'])) {
            throw new BaseException('Empty data');
        }

        return $response['data'];
    }
}
