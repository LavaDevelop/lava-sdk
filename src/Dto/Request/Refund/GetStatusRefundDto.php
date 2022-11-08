<?php

namespace Lava\Api\Dto\Request\Refund;

class GetStatusRefundDto
{

    private string $refundId;

    /**
     * @param string $refundId
     */
    public function __construct(string $refundId)
    {
        $this->refundId = $refundId;
    }

    /**
     * @return string
     */
    public function getRefundId(): string
    {
        return $this->refundId;
    }

}