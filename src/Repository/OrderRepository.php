<?php

namespace App\Repository;

use ShopExpress\ApiClient\ApiClient;

class OrderRepository
{
    public const PAGINATOR_PER_PAGE = 10;

    public function getData(int $offset)
    {
        $apiClient = new ApiClient(
            'lNwzuV_Gb',
            'admin',
            'http://newshop.kupikupi.org/adm/api/'
        );

        $orders = $apiClient->get("orders", ['start' => $offset, 'limit' => self::PAGINATOR_PER_PAGE]);

        return json_decode($orders->getBody(), true);
    }
}
