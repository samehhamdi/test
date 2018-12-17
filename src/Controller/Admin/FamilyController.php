<?php

namespace App\Controller\Admin;

use App\Entity\Family;
use App\Form\FamilyType;
use App\Repository\FamilyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Bridge\Twig\Translation;


/**
 * @Route("/admin/family")
 */
class FamilyController extends AbstractController
{
    /**
     * @Route("/", name="family_index", methods="GET")
     *
     */
    public function index(FamilyRepository $familyRepository): Response
    {
        return $this->render('admin/family/index.html.twig', ['families' => $familyRepository->findAll()]);
    }

    /**
     * @Route("/new", name="family_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {

        $family = new Family();
        $form = $this->createForm(FamilyType::class, $family);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $family->setStatus(1);
            $family->setDateCreated((\DateTime::createFromFormat('Y-m-d', date('Y-m-d'))));
            foreach ($family->getDisciplines() as $key => $discipline) {
                $discipline->setStatus(1);
                $discipline->setDateCreated((\DateTime::createFromFormat('Y-m-d', date('Y-m-d'))));
            }
            $em->persist($family);
            $em->flush();

            return $this->redirectToRoute('family_index');
        }

        return $this->render('admin/family/new.html.twig', [
            'family' => $family,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="family_edit", methods="GET|POST")
     */
    public function edit(Request $request, Family $family): Response
    {
        $form = $this->createForm(FamilyType::class, $family);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($family->getDisciplines() as $key => $discipline) {
                $discipline->setStatus(1);
                $discipline->setDateCreated((\DateTime::createFromFormat('Y-m-d', date('Y-m-d'))));
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('family_index', ['id' => $family->getId()]);
        }

        return $this->render('admin/family/edit.html.twig', [
            'family' => $family,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="family_delete", methods="DELETE")
     */
    public function delete(Request $request, Family $family): Response
    {
        if ($this->isCsrfTokenValid('delete' . $family->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($family);
            $em->flush();
        }

        return $this->redirectToRoute('family_index');
    }
}
