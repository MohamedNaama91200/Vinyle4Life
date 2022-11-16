<?php

namespace App\Controller;

use App\Entity\Objet;
use App\Form\ObjetType;
use App\Repository\ObjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/objet")
 */
class ObjetController extends AbstractController
{
    /**
     * @Route("/", name="app_objet_index", methods={"GET"})
     */
    public function index(ObjetRepository $objetRepository): Response
    {
        return $this->render('objet/index.html.twig', [
            'objets' => $objetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_objet_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ObjetRepository $objetRepository): Response
    {
        $objet = new Objet();
        $form = $this->createForm(ObjetType::class, $objet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objetRepository->add($objet, true);

            return $this->redirectToRoute('app_objet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('objet/new.html.twig', [
            'objet' => $objet,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_objet_show", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show(Objet $objet): Response
    {
        return $this->render('objet/show.html.twig', [
            'objet' => $objet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_objet_edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Objet $objet, ObjetRepository $objetRepository): Response
    {
        $form = $this->createForm(ObjetType::class, $objet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objetRepository->add($objet, true);

            return $this->redirectToRoute('app_objet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('objet/edit.html.twig', [
            'objet' => $objet,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_objet_delete", methods={"POST"}, requirements={"id"="\d+"})
     */
    public function delete(Request $request, Objet $objet, ObjetRepository $objetRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$objet->getId(), $request->request->get('_token'))) {
            $objetRepository->remove($objet, true);
        }

        return $this->redirectToRoute('app_objet_index', [], Response::HTTP_SEE_OTHER);
    }
}
