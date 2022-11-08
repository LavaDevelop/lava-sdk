<?php

namespace Lava\Api\Contracts\Client;

interface ClientGenerateSignatureContract
{

    /**
     * @param array $data
     * @return string
     */
    public function generateSignature(array $data): string;

}