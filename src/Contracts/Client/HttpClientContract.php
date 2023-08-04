<?php

namespace Lava\Api\Contracts\Client;

interface HttpClientContract
{

    /**
     * @param string $method
     * @param string $data
     * @param int $timeout
     * @return array
     */
    public function postRequest(string $method, string $data, int $timeout = 5): array;

    /**
     * @param string $method
     * @param array $data
     * @param int $timeout
     * @return array
     */
    public function getRequest(string $method, array $data, int $timeout = 5): array;

}