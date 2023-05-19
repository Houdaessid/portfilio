<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EducationsController extends AbstractController
{
    #[Route('/educations', name: 'app_educations')]
    public function index(): Response
    {
        return $this->render('educations/index.html.twig', [
            'controller_name' => 'EducationsController',
        ]);
    }
}
