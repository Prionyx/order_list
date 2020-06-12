<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;

class OrderController extends AbstractController
{
    /**
     * @Route("/orders", name="orders")
     */
    public function show(Request $request, Environment $twig, ValidatorInterface $validator): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $orderRepository = new OrderRepository();
        $data = $orderRepository->getData($offset);

        $total = $data['total'];
        $previous = $offset - OrderRepository::PAGINATOR_PER_PAGE;
        $next = $offset + OrderRepository::PAGINATOR_PER_PAGE;

        $orders = [];
        foreach ($data['orders'] as $order) {
            $order = new Order(
                $order['order_id'],
                $order['email'],
                $order['status'],
                $order['summ']
            );
            $orders[$order->getId()]['data'] = $order;
            $orders[$order->getId()]['errors'] = '';
            $errors = $validator->validate($order);
            if ($errors->count() > 0) {
                /** @var ConstraintViolation $error */
                foreach ($errors as $error) {
                    $orders[$order->getId()]['errors'] .= $error->getPropertyPath() .  ': ' . $error->getMessage() . PHP_EOL;
                }
            }
        }

        return new Response($twig->render(
            'orders/table.html.twig',
            compact('orders', 'total', 'previous', 'next', 'offset', 'errors')
        ));
    }
}
