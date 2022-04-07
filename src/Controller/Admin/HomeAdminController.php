<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
class HomeAdminController extends AbstractController
{
    #[Route('/admin', name:'app_admin_home_home')]
    public function home(): Response
    {
        return $this->render('admin/home/home.html.twig');
    }
}
