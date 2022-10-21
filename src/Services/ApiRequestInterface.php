<?php

namespace App\Services;

/**
 * Interface ApiRequestInterface
 * @package App\Services
 */
interface ApiRequestInterface
{
    public function sendApiRequest(string $url, string $method, $options);
}