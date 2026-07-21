<?php

namespace Lava\Api\Dto\Response\Recurrent;

class UnsubscribedSubscriptionDto
{
    private bool $unsubscribed;

    public function __construct(array $response)
    {
        $this->unsubscribed = (bool)$response['unsubscribed'];
    }

    public function isUnsubscribed(): bool
    {
        return $this->unsubscribed;
    }
}
