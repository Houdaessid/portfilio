<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;

class ProjectsController extends AbstractController
{
    #[Route('/projects', name: 'app_projects')]
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('projects/index.html.twig', [
            // 'projects' => $projectRepository->findBy([], ["position" => "ASC"]),
            'projects' => [],
        ]);
    }

    #[Route('/projects/new', name: 'project_new')]
    public function new(): Response
    {
        return $this->render('projects/new.html.twig', [
            'controller_name' => 'ProjectsController',
        ]);
    }
}
