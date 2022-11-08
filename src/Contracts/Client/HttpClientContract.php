<?php

namespace Lava\Api\Contracts\Client;

interface HttpClientContract
{

    /**
     * @param string $method
     * @param string $data
     * @return array
     */
    public function postRequest(string $method, string $data): array;

    /**
     * @param string $method
     * @param array $data
     * @return array
     */
    public function getRequest(string $method, array $data): array;

}