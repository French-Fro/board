<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\semantic\ProjectsGui;
use App\Repository\ProjectRepository;

class ProjectsController extends Controller{
    /**
     * @Route("/index", name="index")
     */
    public function index(ProjectsGui $gui){
        $gui->buttons();
        return $gui->renderView('projects/index.html.twig');
    }

    /**
     * @Route("/projects", name="projects")
     * @param ProjectRepository $projectRepo
     * @return Response
     */
    public function all(ProjectRepository $projectRepo){
        $projects=$projectRepo->findAll();
        return $this->render('projects/all.html.twig',["projects"=>$projects]);
    }
}