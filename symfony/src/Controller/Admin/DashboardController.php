<?php

namespace App\Controller\Admin;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="dashboard")
     */
    public function dashboard()
    {
        $persons = $this->getDoctrine()
            ->getRepository(Person::class)
            ->findAll();

        //$enrollments = $this->

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'Test',
            'persons' => $persons
        ]);
    }
}