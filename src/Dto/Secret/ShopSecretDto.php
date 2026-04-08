<?php

namespace Lava\Api\Dto\Secret;

final class ShopSecretDto
{
    private string $shopId;
    private string $secretKey;
    private ?string $additionalKey;

    /**
     * @param string $shopId
     * @param string $secretKey
     * @param string|null $additionalKey
     */
    public function __construct(
        string  $shopId,
        string  $secretKey,
        ?string $additionalKey = null
    )
    {
        $this->shopId = $shopId;
        $this->secretKey = $secretKey;
        $this->additionalKey = $additionalKey;
    }

    /**
     * @return string
     */
    public function getShopId(): string
    {
        return $this->shopId;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * @return string
     */
    public function getAdditionalKey(): string
    {
        return $this->additionalKey;
    }
}