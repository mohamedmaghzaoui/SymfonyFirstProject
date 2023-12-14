<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends AbstractController
{
    #[Route("/project", name: "homepage")]
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {

        //Create a new project
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($project);
            $entityManager->flush();


            # code...
        }
        //ReadALL projects
        $repository = $doctrine->getRepository(Project::class);
        $projects = $repository->findAll();

        return $this->render('project/project.html.twig', [

            "form" => $form->createView(),
            "projects" => $projects

        ]);
    }
    //delte a project
    #[Route("/delete/{id}", name: "delete_project")]

    public function delete(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();
        $project = $entityManager->getRepository(Project::class)->find($id);

        if (!$project) {
            return $this->redirectToRoute('homepage');
        }

        $entityManager->remove($project);
        $entityManager->flush();

        return $this->redirectToRoute('homepage'); // Redirect to the homepage or any other route
    }
    //edit project
    #[Route("/edit/{id}", name: "edit_project")]
    public function edit(Request $request, ManagerRegistry $doctrine, Project $project): Response
    {
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('homepage');


            # code...
        }
        return $this->render('project/projectEdit.html.twig', [
            "form" => $form->createView()
        ]);
    }
    //read project
    #[Route("/read/{id}", name: "read_project")]
    public function read(ManagerRegistry $doctrine, Project $project): Response
    {
        return $this->render("project/projectRead.html.twig", [
            'project' => $project
        ]);
    }
}
