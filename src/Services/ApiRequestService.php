<?php


namespace App\Services;


/**
 * Class ApiRequestService
 * @package App\Services
 */
class ApiRequestService
{

    private $apiRequest;

    const BASE_URL_REQUEST = 'https://www.elibrary.ru/';

    /**
     * @return mixed
     */
    public function getUrlData($url = "")
    {
        return $this->apiRequest->sendApiRequest($url);
    }

    /**
     * @param ApiRequestInterface $apiRequest
     */
    public function setApiRequestHelper(ApiRequestInterface $apiRequest)
    {
        $this->apiRequest = $apiRequest;
    }

    public function getApiRequestHelper(): ApiRequestInterface
    {
        return $this->apiRequest;
    }
}