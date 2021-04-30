<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="to_do_list")
     */
    public function index()
    {
      $tasks = $this->getDoctrine()->getRepository(Task::class)->findBy([],['id'=>'DESC']);
      return $this->render('index.html.twig',['tasks'=>$tasks]);
    }

    /**
     * @Route("/create", name="create_task", methods={"POST"})
     */
    public function create(Request $request)
    {
        $title = trim($request->request->get('title'));
        if(empty($title))
            return $this->redirectToRoute('to_do_list');

        $entityManager = $this->getDoctrine()->getManager();
        $task = new Task();
        $task->setTitle($title);
        $task->setStatus('0');
        $entityManager->persist($task); //prepare query
        $entityManager->flush(); //saves to database

        return $this->redirectToRoute('to_do_list');
    }
    /**
     * @Route("/switch-status/{id}", name="switch-status")
     */
    public function switchStatus($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);
        $task->setStatus(!$task->getStatus());
        $entityManager->flush(); //saves to database
        return $this->redirectToRoute('to_do_list');
    }
    /**
     * @Route("/delete/{id}", name="task_delete")
     */
    public function delete(Task $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($id);
        $entityManager->flush(); //saves to database
        return $this->redirectToRoute('to_do_list');

    }


}
