<?php

declare(strict_types=1);

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name:"app_front_home_home")]
    public function home() :Response
    {
        return $this->render("front/home/home.html.twig");
    }
}
