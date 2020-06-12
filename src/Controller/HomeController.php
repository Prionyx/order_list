<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Environment $twig, ValidatorInterface $validator)
    {
        $orderRepository = new OrderRepository();
        $data = $orderRepository->getData();

        $orders = [];
        foreach ($data['orders'] as $order) {
            $orders[] = new Order(
                $order['order_id'],
                $order['email'],
                $order['status'],
                $order['summ']
            );
        }

        return new Response($twig->render(
            'homepage/index.html.twig',
            compact('orders')
        ));
    }
}
