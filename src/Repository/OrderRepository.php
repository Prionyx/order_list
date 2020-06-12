<?php

namespace App\Repository;

use ShopExpress\ApiClient\ApiClient;

class OrderRepository
{
    public function getData()
    {
        $apiClient = new ApiClient(
            'lNwzuV_Gb',
            'admin',
            'http://newshop.kupikupi.org/adm/api/'
        );

        $orders = $apiClient->get("orders");

        return json_decode($orders->getBody(), true);
    }
}
