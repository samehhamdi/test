<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/skill")
 */
class SkillController extends AbstractController
{
    /**
     * @Route("/", name="skill_index", methods="GET")
     */
    public function index(SkillRepository $skillRepository): Response
    {
        return $this->render('admin/skill/index.html.twig', ['skills' => $skillRepository->findAll()]);
    }

    /**
     * @Route("/new", name="skill_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $skill->setStatus(1);
            $skill->setDateCreated((\DateTime::createFromFormat('Y-m-d', date('Y-m-d'))));
            foreach ($skill->getLevels() as $key => $level) {
                $level->setGrade($key + 1);
            }

            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute('skill_index');
        }

        return $this->render('admin/skill/new.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="skill_edit", methods="GET|POST")
     */
    public function edit(Request $request, Skill $skill): Response
    {
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('skill_index', ['id' => $skill->getId()]);
        }

        return $this->render('admin/skill/edit.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="skill_delete", methods="DELETE")
     */
    public function delete(Request $request, Skill $skill): Response
    {
        if ($this->isCsrfTokenValid('delete' . $skill->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($skill);
            $em->flush();
        }

        return $this->redirectToRoute('skill_index');
    }
}
