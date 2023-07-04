<?php

namespace Lava\Api\Dto\Response\Payoff;

class CheckWalletResponseDto
{

    /**
     * @var bool
     */
    private bool $status;

    /**
     *
     */
    public function __construct(bool $status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

}