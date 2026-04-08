<?php

namespace Feature\Profile;

use JsonException;
use Lava\Api\Dto\Response\Profile\ProfileBalanceDto;
use Lava\Api\Dto\Secret\ProfileSecretDto;
use Lava\Api\Exceptions\BaseException;
use Lava\Api\Exceptions\Profile\ProfileException;
use Lava\Api\Http\LavaFacade;
use PHPUnit\Framework\TestCase;
use Test\Lava\Api\Mocks\Client\ClientErrorResponseMock;
use Test\Lava\Api\Mocks\Client\ClientSuccessResponseMock;

class ProfileTest extends TestCase
{
    /**
     * @throws JsonException
     * @throws BaseException
     */
    public function testGetProfileBalanceSuccess(): void
    {
        $mockClient = new ClientSuccessResponseMock();

        $secretKey = uniqid('', true);
        $additionalKey = uniqid('', true);
        $shopId = uniqid('', true);

        $profileSecretData = new ProfileSecretDto(
            uniqid('', true),
            uniqid('', true),
            uniqid('', true),
        );

        $facade = new LavaFacade($secretKey, $shopId, $additionalKey, $mockClient, null, null, $profileSecretData);

        $response = $facade->getProfileBalance();

        $this->assertIsObject($response);
        $this->assertEquals(ProfileBalanceDto::class, get_class($response));
        $this->assertEquals(10000, $response->getTotalBalance());
        $this->assertEquals(8000, $response->getAvailableBalance());
        $this->assertEquals(2000, $response->getFreezeBalance());
    }

    /**
     * @throws JsonException
     * @throws BaseException
     */
    public function testGetProfileBalanceError(): void
    {
        $mockClient = new ClientErrorResponseMock();

        $secretKey = uniqid('', true);
        $additionalKey = uniqid('', true);
        $shopId = uniqid('', true);

        $profileSecretData = new ProfileSecretDto(
            uniqid('', true),
            uniqid('', true),
            uniqid('', true),
        );

        $facade = new LavaFacade($secretKey, $shopId, $additionalKey, $mockClient, null, null, $profileSecretData);

        $this->expectException(ProfileException::class);
        $facade->getProfileBalance();
    }
}