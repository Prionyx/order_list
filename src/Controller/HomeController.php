<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request,Environment $twig, ValidatorInterface $validator)
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $orderRepository = new OrderRepository();
        $data = $orderRepository->getData($offset);

        $total = $data['total'];
        $previous = $offset - OrderRepository::PAGINATOR_PER_PAGE;
        $next = $offset + OrderRepository::PAGINATOR_PER_PAGE;

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
            compact('orders', 'total', 'previous', 'next')
        ));
    }
}
