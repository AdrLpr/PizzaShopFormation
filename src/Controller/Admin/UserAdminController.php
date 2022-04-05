<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
}
