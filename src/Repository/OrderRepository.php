<?php

namespace App\Repository;

use ApiClient;

class OrderRepository
{
    public const PAGINATOR_PER_PAGE = 10;

    private $apiUser;
    private $apiPass;
    private $apiUrl;

    public function __construct(string $apiUser, string $apiPass, string $apiUrl)
    {
        $this->apiUser = $apiUser;
        $this->apiPass = $apiPass;
        $this->apiUrl = $apiUrl;
    }

    public function getData(int $offset)
    {
        $apiClient = new ApiClient(
            $this->apiPass,
            $this->apiUser,
            $this->apiUrl
        );

        $orders = $apiClient->get("orders", ['start' => $offset, 'limit' => self::PAGINATOR_PER_PAGE]);

        return json_decode($orders->getBody(), true);
    }
}
