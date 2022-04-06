<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Form\AdressType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class ConfirmController extends AbstractController
{
    #[Route('/panier/confirm', name:'app_front_confirm_adress')]
    public function adress(Request $request, UserRepository $repository)
    {
        $form = $this->createForm(AdressType::class, $this->getUser());

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();

            $repository->add($user);

            return $this->redirectToRoute('app_front_confirm_valid');
        }

        $formView = $form->createView();
        return $this->render('front/confirm/formAdress.html.twig',[
            'formView' => $formView
    ]);
    }

    #[Route('/panier/confirm/valid', name:'app_front_confirm_valid')]
    public function valid(): Response
    {
        return $this->render('front/confirm/valid.html.twig');
    }
}
