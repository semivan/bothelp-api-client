<?php

namespace Bothelp;

use Symfony\Component\HttpClient\HttpClient;

class BothelpApi
{
    const API_URL       = 'https://api.bothelp.io/v1/';
    const OAUTH_API_URL = 'https://oauth.bothelp.io/';

    /** @var HttpClient */
    private $httpClient;

    /** @var string */
    private $clientId;

    /** @var string */
    private $clientSecret;

    /** @var array */
    private $accessToken;

    public function __construct(string $clientId, string $clientSecret)
    {
        $this->httpClient   = HttpClient::create();
        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return array
     * @throws \Throwable
     */
    private function auth(): array
    {
        return $this->request('oauth2/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
        ], 'POST');
    }

    /**
     * @return array
     * @throws \Throwable
     */
    private function getAccessToken(): array
    {
        if (!$this->accessToken) {
            $this->accessToken = $this->auth();
        }

        return $this->accessToken;
    }

    /**
     * @param string $endpoint
     * @param array $params
     * @param string $method
     * @return array
     * @throws \Throwable
     */
    public function request(string $endpoint, array $params = [], string $method = 'POST'): array
    {
        $apiUrl  = self::API_URL;

        if (strtoupper($method) === 'GET') {
            $options = ['query' => $params];
        } elseif (strtoupper($method) === 'POST' && $endpoint === 'oauth2/token') {
            $options = ['body' => $params];
        } else {
            $options = ['body' => json_encode($params)];
        }

        if ($endpoint !== 'oauth2/token') {
            $token = $this->getAccessToken();
            $options['headers']['Authorization'] = $token['token_type'] .' '. $token['access_token'];
        } else {
            $apiUrl = self::OAUTH_API_URL;
        }

        $response = $this->httpClient->request($method, $apiUrl . $endpoint, $options);

        try {
            return $response->toArray();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . ' ('. $response->getContent(false) .')');
        }
    }
}