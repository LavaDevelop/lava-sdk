<?php

namespace Lava\Api\Dto\Secret;

final class ProfileSecretDto
{
    private string $profileId;
    private string $secretKey;
    private ?string $additionalKey;

    /**
     * @param string $profileId
     * @param string $secretKey
     * @param string|null $additionalKey
     */
    public function __construct(
        string  $profileId,
        string  $secretKey,
        ?string $additionalKey = null
    )
    {
        $this->profileId = $profileId;
        $this->secretKey = $secretKey;
        $this->additionalKey = $additionalKey;
    }

    /**
     * @return string
     */
    public function getProfileId(): string
    {
        return $this->profileId;
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
    public function getAdditionalKey(): ?string
    {
        return $this->additionalKey;
    }
}