<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientAdminController extends AbstractController
{
    #[Route('/admin/ingredient/new', name:"app_admin_ingredient_create")]
    public function create(IngredientRepository $repository , Request $request) : Response
    {
        $form = $this->createForm(IngredientType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $repository->add($form->getData());

            return $this->redirectToRoute("app_admin_ingredient_retrieve");
        }

        $formView = $form->createView();
        return $this->render('admin/ingredient/create.html.twig', [
            'formView'=> $formView,
        ]);
    }

    #[Route('/admin/ingredient/list', "app_admin_ingredient_retrieve")]
    public function retrieve(IngredientRepository $repository ): Response
    {
        $ingredients=$repository->findAll();

        return $this->render('admin/ingredient/retrieve.html.twig', [
            'ingredients'=> $ingredients
        ]);
    }
}
