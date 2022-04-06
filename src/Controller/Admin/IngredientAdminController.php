<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
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

    #[Route('/admin/ingredient/list',name: "app_admin_ingredient_retrieve")]
    public function retrieve(IngredientRepository $repository ): Response
    {
        $ingredients=$repository->findAll();

        return $this->render('admin/ingredient/retrieve.html.twig', [
            'ingredients'=> $ingredients
        ]);
    }

    #[Route('/admin/ingredient/{id}/update', name:"app_admin_ingredient_update")]
    public function update(Ingredient $ingredient,IngredientRepository $repository, Request $request ): Response
    {

        if (!$ingredient){
            return new Response("L'ingrédients n'existe pas", 404);
        }

        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $repository->add($form->getData());

            return $this->redirectToRoute("app_admin_ingredient_retrieve");
        }

        $formView = $form->createView();

        return $this->render('admin/ingredient/update.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/admin/ingredient/{id}/delete', name:"app_admin_ingredient_delete")]
    public function delete(Ingredient $ingredient,IngredientRepository $repository, Request $request ): Response
    {

        if (!$ingredient){
            return new Response("L'ingrédients n'existe pas", 404);
        }

        $repository->remove($ingredient);

        return $this->redirectToRoute('app_admin_ingredient_retrieve');
    }
}
