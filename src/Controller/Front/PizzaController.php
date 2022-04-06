<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    #[Route("/pizza" , name:"app_pizza_retrieve")]
    public function retrieve(PizzaRepository $repository) :Response
    {
        $pizzas=$repository->findAll();
        return $this->render('front/pizza/show.html.twig', [
            'pizzas'=> $pizzas
        ]);
    }
}
