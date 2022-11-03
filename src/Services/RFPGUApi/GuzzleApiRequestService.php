<?php


namespace App\Services\RFPGUApi;


use GuzzleHttp\Client;

class GuzzleApiRequestService implements ApiRequestInterface
{
    private $client;

    private $baseUrl;

    /**
     * GuzzleHelperService constructor.
     * @param string $baseUrl
     */
    public function __construct(
        string $baseUrl
    )
    {

        $config = ['base_uri' => $baseUrl ];

        $this->baseUrl = $baseUrl;
        $this->client = new Client($config);
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendApiRequest(string $url = '', string $method = 'GET', $options = [])
    {
        return $this->client->request($method, $url, $options);
    }
}
