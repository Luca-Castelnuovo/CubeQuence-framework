<?php

declare(strict_types=1);

namespace CQ\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Guzzle
{
    /**
     * Make guzzle http request
     *
     * @param array $data optional
     *
     * @throws \Exception
     */
    public static function request(string $method, string $url, array $data = []): object
    {
        $guzzle = new Client();

        try {
            $response = $guzzle->request(
                method: $method,
                uri: $url,
                options: $data
            );

            $data = json_decode(json: $response->getBody());

            return (object) [
                'response' => $response,
                'data' => $data,
            ];
        } catch (RequestException $e) {
            throw new \Exception(
                message: $e->getResponse()->getBody(true) // TODO: check if (true) is neccessary
            );
        }
    }
}
