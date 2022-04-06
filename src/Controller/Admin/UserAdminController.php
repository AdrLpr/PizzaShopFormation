<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


#[IsGranted('ROLE_ADMIN')]
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
       $form = $this->createForm(UserType::class);

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

    #[Route('/admin/user/{id}/update', name:"app_admin_user_update")]
    public function update(User $user,userRepository $repository, Request $request ): Response
    {

        if (!$user){
            return new Response("L'utilisateur n'existe pas", 404);
        }

        $form = $this->createForm(userType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $repository->add($form->getData());

            return $this->redirectToRoute("app_admin_user_retrieve");
        }

        $formView = $form->createView();

        return $this->render('admin/user/update.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/admin/user/{id}/delete', name:"app_admin_user_delete")]
    public function delete(User $user,userRepository $repository, Request $request ): Response
    {

        if (!$user){
            return new Response("L'utilisateur n'existe pas", 404);
        }

        $repository->remove($user);

        return $this->redirectToRoute('app_admin_user_retrieve');
    }
}
