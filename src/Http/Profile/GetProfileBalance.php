<?php

namespace Lava\Api\Http\Profile;

use Lava\Api\Contracts\Profile\GetProfileBalanceContract;
use Lava\Api\Dto\Response\Profile\ProfileBalanceDto;
use Lava\Api\Exceptions\BaseException;

class GetProfileBalance implements GetProfileBalanceContract
{
    /**
     * @param string $profileId
     * @return array<string, mixed>
     */
    public function toArray(string $profileId): array
    {
        return [
            'profileId' => $profileId
        ];
    }

    /**
     * @throws BaseException
     */
    public function toDto(array $response): ProfileBalanceDto
    {
        if (empty($response['data'])) {
            throw new BaseException('Empty data');
        }

        $data = $response['data'];

        return new ProfileBalanceDto(
            $data['balance'],
            $data['active_balance'],
            $data['freeze_balance'],
        );
    }
}