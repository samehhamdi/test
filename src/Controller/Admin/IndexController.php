<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\FamilyRepository;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    /**
     * @Route("/admin", name="index")
     */

        public function index(FamilyRepository $familyRepository): Response
        {
        return $this->render('admin/index/index.html.twig', ['families' => $familyRepository->findAll()]);


        }
}
