<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Form\PizzaType;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaAdminController extends AbstractController
{
    #[Route("/admin/pizza/new", name:"app_admin_pizza_create")]
    public function create(PizzaRepository $repository, Request $request): Response
    {
        $form = $this->createForm(PizzaType::class);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $repository->add($form->getData());

            return $this->redirectToRoute("app_admin_pizza_retrieve");
        }

        $formView = $form->createView();
        return $this->render('admin/pizza/create.html.twig', [
            'formView'=> $formView,
        ]);
    }
    
    #[Route('/admin/pizza/list', "app_admin_pizza_retrieve")]
    public function retrieve(PizzaRepository $repository ): Response
    {
        $pizzas=$repository->findAll();

        return $this->render('admin/pizza/retrieve.html.twig', [
            'pizzas'=> $pizzas
        ]);
    }
}
