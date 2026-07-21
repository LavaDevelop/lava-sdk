<?php

namespace Lava\Api\Dto\Response\Recurrent;

class OffsetNextPayTimeResponseDto
{
    private string $nextPayTime;

    public function __construct(array $response)
    {
        $this->nextPayTime = $response['next_pay_time'];
    }

    public function getNextPayTime(): string
    {
        return $this->nextPayTime;
    }
}
