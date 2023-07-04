<?php

namespace Lava\Api\Dto\Request\Payoff;

class CheckWalletRequestDto
{

    /**
     * @var string
     */
    private string $service;
    /**
     * @var string
     */
    private string $walletTo;


    /**
     * @param string $service
     * @param string $walletTo
     */
    public function __construct(string $service, string $walletTo)
    {
        $this->service = $service;
        $this->walletTo = $walletTo;
    }


    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @return string
     */
    public function getWallet(): string
    {
        return $this->walletTo;
    }


}