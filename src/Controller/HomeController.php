<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Environment $twig)
    {
        $orderRepository = new OrderRepository();
        $data = $orderRepository->getData();
        dump($data);

        return new Response($twig->render('homepage/index.html.twig'));
    }
}
