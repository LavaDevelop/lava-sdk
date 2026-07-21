<?php

namespace Lava\Api\Dto\Request\Recurrent;

class CreateConsumerDto
{
    private string $email;
    private string $consumerId;
    private ?string $phone;
    private ?string $name;

    public function __construct(string $email, string $consumerId, ?string $phone = null, ?string $name = null)
    {
        $this->email = $email;
        $this->consumerId = $consumerId;
        $this->phone = $phone;
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getConsumerId(): string
    {
        return $this->consumerId;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
