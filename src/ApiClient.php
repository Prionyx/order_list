<?php

use ShopExpress\ApiClient\ApiClient as ShopApiClient;
use ShopExpress\ApiClient\Exception\NetworkException;
use ShopExpress\ApiClient\Exception\RequestException;
use ShopExpress\ApiClient\Response\ApiResponse;

class ApiClient extends ShopApiClient
{
    /**
     * Get api method.
     *
     * @param string $objectUrl The object url
     * @param array $params The parameters
     *
     * @return ApiResponse
     * @throws NetworkException
     * @throws RequestException
     */
    public function get($objectUrl, $params = [])
    {
        return $this->api('GET', $objectUrl, null, $params);
    }
}