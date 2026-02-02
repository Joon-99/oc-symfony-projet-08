<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends AbstractController
{
    #[Route('/task/{id}/edit', name: 'app_task_edit', methods: ['GET', 'POST'])]
    public function taskEdit(Task $task, Request $request, EntityManagerInterface $entityManager): Response {
        if (!$task) {
            throw $this->createNotFoundException('Tâche introuvable');
        }
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($task);
            $entityManager->flush();
            return $this->redirectToRoute('app_project_show', ['id' => $task->getProject()->getId()]);
        }

        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }
}