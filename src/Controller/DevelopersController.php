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
     * @Route("/refresh", name="refresh-dev")
     */
    public function refresh(DevelopersGui $gui,DeveloperRepository $devR){
        $dev=$devR->findAll();
        $dt=$gui->dataTable($dev);
        $gui->getOnClick("#dev-insert","developers/insert","#dev-view",["attr"=>""]);
        return new Response($dt);
    }
    /**
     * @Route("developers/insert", name="developers_insert")
     */
    public function insert(DevelopersGui $devGui){
        $devGui->frm();
        return $devGui->renderView('developers/frm.html.twig');
    }
    /**
     * @Route("developers/update/{id}", name="developers_update")
     */
    public function update($id,DevelopersGui $devGui,DeveloperRepository $devRepo){
        $dev=$devRepo->find($id);
        $devGui->frm($dev);
        return $devGui->renderView('developers/frm.html.twig');
    }
    /**
     * @Route("developers/delete/{id}", name="developers_delete")
     */
    public function delete($id,DevelopersGui $devGui,DeveloperRepository $devRepo){
        $dev=$devRepo->find($id);
        $devRepo->delete($dev);
        return $this->redirectToRoute("re");
    }

    /**
     * @Route("developers/submit", name="developers_submit")
     */
    public function submit(Request $request,DeveloperRepository $devRepo){
        if($dev=$devRepo->find($request->get("id"))==""){
            $dev=new Developer();
            $dev->setIdentity($request->get("identity"));
            $devRepo->insert($dev);
            return $this->forward("App\Controller\DevelopersController::developers");
        }
        else{
            $dev=$devRepo->find($request->get("id"));
            if(isset($dev)){
                $dev->setIdentity($request->get("identity"));
                $devRepo->update($dev);
            }
            return $this->forward("App\Controller\DevelopersController::developers");
        }
    }






}
