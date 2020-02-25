<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProjectFormType;
use App\Utils\MergeProjectPerson;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/admin")
 */
class ProjectController extends AbstractController
{

    /**
     * @Route("/project/list", name="admin_project_list")
     */
    public function list(EntityManagerInterface $em)
    {
        $projects = $em->getRepository(Project::class)->findAll();
        
        return $this->render('admin/project/list.html.twig', [
            'projects' => $projects,
        ]);
    }

    /**
     * @Route("/project/{id}/mergetoperson", name="admin_project_mergetoperson")
     */
    public function mergetoperson(Project $project, EntityManagerInterface $em, MergeProjectPerson $mergeProjectPerson)
    {
        $mergeProjectPerson->mergeProjectToPerson($project);

        foreach($msgs = $mergeProjectPerson->getMsgs() as $msg){
            $this->addFlash($msg[0],$msg[1]);
        }

        return $this->redirectToRoute('admin_project_list');
    }




}
