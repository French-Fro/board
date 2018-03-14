<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Repository\DeveloperRepository;
use App\Services\semantic\DevelopersGui;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\semantic\ProjectsGui;
use App\Repository\ProjectRepository;

class DevelopersController extends Controller
{
    /**
     * @Route("/developers", name="developers")
     */
    public function index(DevelopersGui $gui,DeveloperRepository $devR)
    {
        $dev=$devR->findAll();
        $dt=$gui->dataTable($dev);
        $gui->getOnClick("#dev-insert","developers/insert","#dev-view",["attr"=>""]);
        return $gui->renderView('developers/index.html.twig',["developers"=>$dev]);
    }
    /**
     * @Route("developers/insert", name="developers_insert")
     */
    public function insert(DevelopersGui $devGui){
        $devGui->frm();
        return $devGui->renderView('developers/frm.html.twig');
    }
    /**
     * @Route("developers/submit", name="developers_submit")
     */
    public function submit(Request $request,DeveloperRepository $devRepo){
        $dev=new Developer();
        $dev->setIdentity($request->get("identity"));
        $devRepo->insert($dev);
        return $this->forward("App\Controller\DevelopersController::insert");
    }

}
