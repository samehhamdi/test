<?php

namespace App\Controller\Admin;

use App\Entity\Discipline;
use App\Entity\Skill;
use App\Repository\FamilyRepository;
use App\Repository\SkillRepository;
use App\Form\DisciplineType;
use App\Repository\DisciplineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/discipline")
 */
class DisciplineController extends AbstractController
{
    /**
     * @Route("/", name="discipline_index", methods="GET")
     */
    public function index(DisciplineRepository $disciplineRepository): Response
    {
        return $this->render('admin/discipline/index.html.twig', ['disciplines' => $disciplineRepository->findAll()]);
    }

    /**
     * @Route("/new", name="discipline_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {

        $discipline = new Discipline();

        $form = $this->createForm(DisciplineType::class, $discipline);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $discipline->setStatus(1);
            $discipline->setDateCreated((\DateTime::createFromFormat('Y-m-d', date('Y-m-d'))));
            foreach ($discipline->getDisciplinesd() as $key => $disciplined) {
                $disciplined->setDateCreated((\DateTime::createFromFormat('Y-m-d', date('Y-m-d'))));
                $disciplined->setJobCode(substr($discipline->getTitleEn(),0,3).$disciplined->getDisciplineLevel());
            }
            $em->persist($discipline);
            $em->flush();

            return $this->redirectToRoute('discipline_index');
        }

        //  if($family_id = $request->get('family')){
        //      dump($family_id);
        //     $form->get('family')->setData($family_id);
        // }

        return $this->render('admin/discipline/new.html.twig', [
            'discipline' => $discipline,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="discipline_edit", methods="GET|POST")
     */
    public function edit(Request $request, Discipline $discipline, SkillRepository $skillRepo): Response
    {
        $form = $this->createForm(DisciplineType::class, $discipline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($discipline->getDisciplinesd() as $key => $disciplined) {
                $disciplined->setDateCreated((\DateTime::createFromFormat('Y-m-d', date('Y-m-d'))));
                $disciplined->setJobCode(substr($discipline->getTitleEn(),0,3).'0'.$disciplined->getDisciplineLevel());
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('discipline_edit', ['id' => $discipline->getId()]);
        }

        return $this->render('admin/discipline/edit.html.twig', [
            'skills' => $skillRepo->findAll(),
            'discipline' => $discipline,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="discipline_delete", methods="DELETE")
     */
    public function delete(Request $request, Discipline $discipline): Response
    {
        if ($this->isCsrfTokenValid('delete' . $discipline->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($discipline);
            $em->flush();
        }

        return $this->redirectToRoute('discipline_index');
    }


    /**
     * @Route("/{id}/updateFamily", name="update_discipline_family", methods="GET")
     */
    public function updateFamily(Request $request, Discipline $discipline, FamilyRepository $familyRepo): Response
    {
        $familyId = $request->get('familyID');
        if( $family = $familyRepo->find($familyId) ) {
            $discipline->setFamily($family);
            $this->getDoctrine()->getManager()->flush();
            return $this->json(array('response' => true));
        }
        else {
            return $this->json(array('response' => false));
        }
    }
}
