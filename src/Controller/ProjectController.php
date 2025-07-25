<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Project;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Employe;

final class ProjectController extends AbstractController
{
    #[Route('/', name: 'app_project')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // Récupérer le repository pour l'entité Project
         $projectRepository = $doctrine->getRepository(Project::class);

        // Récupérer tous les projets
        $projects = $projectRepository->findAll();

        // Passer les projets au template
        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }
    #[Route('/project/add', name: 'project_add')]
    public function addProject(ManagerRegistry $doctrine): Response
    {
        // Récupérer le repository pour l'entité Project
        $employeRepository = $doctrine->getRepository(Employe::class);
        // Récupérer tous les employés
        $employes = $employeRepository->findAll();
        // Passer les emplyés au template
        return $this->render('project/project_add.html.twig', [
            'employes' => $employes,
        ]);
    }
}
