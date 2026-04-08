<?php

namespace Lava\Api\Contracts\Profile;

use Lava\Api\Dto\Response\Profile\ProfileBalanceDto;

interface GetProfileBalanceContract
{
    /**
     * @param string $profileId
     * @return array
     */
    public function toArray(string $profileId): array;

    /**
     * @param array $response
     * @return ProfileBalanceDto
     */
    public function toDto(array $response): ProfileBalanceDto;
}