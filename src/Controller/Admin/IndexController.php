<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\FamilyRepository;
use App\Repository\DisciplineRepository;
use App\Repository\SkillRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

class IndexController extends AbstractController
{
    /**
     * @Route("/admin", name="index")
     */

    public function index(FamilyRepository $fR, DisciplineRepository $dR, SkillRepository $sR): Response
    {


        $request=new Request();
        $session = $request->hasPreviousSession();
        if($session){

        }
        else {
            $session = new Session(new NativeSessionStorage(), new AttributeBag());
            $session->set('token', 'a6c1e0b6');

        }
       // dump($session);die;
        return $this->render('admin/index/index.html.twig',
            array(
                'families' => $fR->findAll(),
                'disciplines' => $dR->findAll(),
                'skills' => $sR->findAll()
            )
        );


    }
}
