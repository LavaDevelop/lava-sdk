<?php

namespace Lava\Api\Dto\Response\H2h;

use Lava\Api\Exceptions\BaseException;

class CreatedSBPH2hDto
{
    public string $sbpUrl;
    private bool $fingerprint;
    private string $qrCode;

    /**
     * @param string $sbpUrl
     * @param bool $fingerprint
     * @param string $qrCode
     */
    public function __construct(string $sbpUrl, bool $fingerprint, string $qrCode)
    {
        $this->sbpUrl = $sbpUrl;
        $this->fingerprint = $fingerprint;
        $this->qrCode = $qrCode;
    }

    /**
     * @param $name
     * @return mixed
     * @throws BaseException
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new BaseException('Property not found');
    }

    /**
     * @return bool
     */
    public function isFingerprint(): bool
    {
        return $this->fingerprint;
    }

    /**
     * @return string
     */
    public function getQrCode(): string
    {
        return $this->qrCode;
    }

    /**
     * @return string
     */
    public function getSbpUrl(): string
    {
        return $this->sbpUrl;
    }

}