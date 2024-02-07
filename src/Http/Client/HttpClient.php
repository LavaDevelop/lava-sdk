<?php

namespace Lava\Api\Http\Client;

use JsonException;
use Lava\Api\Constants\ClientConstants;
use Lava\Api\Contracts\Client\HttpClientContract;
use Lava\Api\Exceptions\BaseException;

class HttpClient implements HttpClientContract {

    /**
     * @param string $method
     * @param string $data
     * @param int $timeout
     *
     * @return array
     * @throws BaseException
     * @throws JsonException
     */
    public function postRequest(string $method, string $data, int $timeout = 5): array {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, ClientConstants::URL . $method);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, ['Accept: application/json', 'Content-Type: application/json']
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $result = curl_exec($ch);
        curl_close($ch);

        if (is_bool($result)) {
            throw new BaseException('Error request');
        }

        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param string $method
     * @param array $data
     * @param int $timeout
     *
     * @return array
     * @throws BaseException
     * @throws JsonException
     */
    public function getRequest(string $method, array $data, int $timeout = 5): array {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, ClientConstants::URL . $method . '/' . http_build_query($data));
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, ['Accept: application/json', 'Content-Type: application/json']
        );
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $result = curl_exec($ch);
        curl_close($ch);

        if (is_bool($result)) {
            throw new BaseException('Error request');
        }

        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }
}