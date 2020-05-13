<?php

namespace CQ\Captcha;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Captcha
{
    /**
     * Validate captcha
     *
     * @param string $url
     * @param string $secret
     * @param string $response
     * 
     * @return bool
     */
    protected static function validate($url, $secret, $response)
    {
        $guzzle = new Client();

        try {
            $guzzle->request('POST', $url, [
                'form_params' => [
                    'secret' => $secret,
                    'response' => $response,
                    'remoteip' => $_SERVER['REMOTE_ADDR']
                ],
            ]);
        } catch (RequestException $e) {
            return false;
        }

        return true;
    }
}