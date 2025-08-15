<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

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
    public function addProject(Request $request, EntityManagerInterface $entityManager): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('app_project');
        }
        // Passer les projets au template
        return $this->render('project/project_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/project/show/{id}', name: 'project_show')]
    public function showProject(ManagerRegistry $doctrine, int $id): Response
    {
        // Récupérer le repository pour l'entité Project
         $projectRepository = $doctrine->getRepository(Project::class);

        // Récupérer tous les projets
        $project = $projectRepository->find($id);

        // Passer les projets au template
        return $this->render('project/show.html.twig', [
            'project' => $project,
        ]);
    }
    #[Route('/project/edit/{id}', name: 'project_edit')]
    public function editProject(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $project = $entityManager->getRepository(Project::class)->find($id);

        if (!$project) {
            throw $this->createNotFoundException('Projet introuvable');
        }

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush(); // pas besoin de persist, objet déjà géré
            return $this->redirectToRoute('app_project');
        }

        return $this->render('project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/project/delete/{id}', name: 'project_delete')]
    public function deleteProject(ManagerRegistry $doctrine, int $id): Response
    {
        // Récupérer le repository pour l'entité Project
        $projectRepository = $doctrine->getRepository(Project::class);
        $project = $projectRepository->find($id);
        $doctrine->getManager()->remove($project);
        
        $doctrine->getManager()->flush();

        // Passer les projets au template
        return $this->redirectToRoute("app_project");
    }
}
