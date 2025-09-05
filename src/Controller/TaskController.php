<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

final class TaskController extends AbstractController
{

    #[Route('/task/add', name: 'task_add')]
    public function addTask(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        $id=$request->query->get('id');
        if ($form->isSubmitted() && $form->isValid()) {

            $project = $entityManager->getRepository(Project::class)->find($id);
            $task->setProject($project);

            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('project_show',['id'=>$id]);
        }
        // Passer les tâches au template
        return $this->render('task/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/task/show/{id}', name: 'task_show')]
    public function showTask(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine, int $id): Response
    {
        // Récupérer le repository pour l'entité Task
         $taskRepository = $doctrine->getRepository(Task::class);

        // Récupérer toutes les tâches
        $task = $taskRepository->find($id);

        if (!$task) {
            throw $this->createNotFoundException('Projet introuvable');
        }

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($task);
            $entityManager->flush();
            return $this->redirectToRoute('project_show',['id'=>$task->getProject()->getId()]);
        }

        // Passer les tâches au template
        return $this->render('task/show.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/task/delete/{id}', name: 'task_delete')]
    public function deleteTask(ManagerRegistry $doctrine, int $id): Response
    {
        // Récupérer le repository pour l'entité Task
        $taskRepository = $doctrine->getRepository(Task::class);
        $task = $taskRepository->find($id);
        $doctrine->getManager()->remove($task);

        if (!$task) {
            throw $this->createNotFoundException('Tâche introuvable');
        }
         // récupérer le projet avant de supprimer la tâche
        $project = $task->getProject();

        $em = $doctrine->getManager();
        $em->remove($task);
        $em->flush();

        // redirection vers la page du projet
        return $this->redirectToRoute('project_show', ['id' => $project->getId()]);
    }
}
