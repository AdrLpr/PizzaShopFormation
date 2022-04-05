<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Form\SignInType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserAdminController extends AbstractController
{
    #[Route('/admin/user/list', "app_admin_user_retrieve")]
    public function retrieve(UserRepository $repository ): Response
    {
        $users=$repository->findAll();

        return $this->render('admin/user/retrieve.html.twig', [
            'users'=> $users
        ]);
    }

    #[Route('/admin/user/new', "app_admin_user_create")]
    public function create(UserRepository $repository, UserPasswordHasherInterface $passwordHasher, Request $request ): Response
    {
       $form = $this->createForm(SignInType::class);

       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();
            $plainpassword= $user->getPassword();
            
            $hassedpassword = $passwordHasher->hashPassword(
                $user,
                $plainpassword
            );

            $user->setPassword($hassedpassword);

            $repository->add($user);

            return $this->redirectToRoute('app_admin_user_retrieve');
        }
        $formView = $form->createView();
        return $this->render('admin/user/create.html.twig', [
            'formView'=>$formView,
        ]);
    }
}
