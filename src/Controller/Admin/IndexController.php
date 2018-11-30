<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\FamilyRepository;
use App\Repository\DisciplineRepository;
use App\Repository\SkillRepository;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    /**
     * @Route("/admin", name="index")
     */

    public function index(FamilyRepository $fR, DisciplineRepository $dR, SkillRepository $sR): Response
    {
        return $this->render('admin/index/index.html.twig', 
            array(
                'families' => $fR->findAll(),
                'disciplines' => $dR->findAll(),
                'skills' => $sR->findAll()
            )
        );


    }
}
