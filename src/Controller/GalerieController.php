<?php

namespace App\Controller;

use App\Entity\Galerie;
use App\Entity\Objet;

use App\Form\GalerieType;
use App\Repository\GalerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/galerie")
 */
class GalerieController extends AbstractController
{
    /**
     * @Route("/", name="app_galerie_index", methods={"GET"})
     */
    public function index(GalerieRepository $galerieRepository): Response
    {
        if($this->isGranted('ROLE_ADMIN'))
        {
             return $this->render('galerie/index.html.twig', [
            'galerie' => $galerieRepository->findAll(),
        ]);}
        else {
            $privateGalleries = array();
            $user = $this->getUser();
            if($user) {
                $membre = $user->getMembre();
                $privateGalleries = $galerieRepository->findBy(
        [
              'publiee' => false,
              'creator' => $membre
        ]);}
            $publicgallerie = array();
            $publicgallerie = $galerieRepository->findBy(
                [
                      'publiee' => true
                ]);
            $galleries = array_merge($publicgallerie, $privateGalleries );
            
     
             return  $this->render('galerie/index.html.twig', [
              'galerie' => $galleries]);



        }
    }
        
    



    /**
     * @Route("/{id}", name="app_galerie_show", methods={"GET"},requirements={"id":"\d+"})
     */
   /**
 * @Route("/{id}", name="app_galerie_show", methods={"GET"})
 */
public function show(Galerie $galerie): Response
{
    $hasAccess = false;
    if($galerie->isPubliee()) {
        $hasAccess = true;
    }
    else {
            
            if ( $this->getUser()->getMembre() == $galerie->getCreator() ) {

                $hasAccess = true;
            }
            else {
                $hasAccess = false;
            }
        }
    
    if(! $hasAccess) {
        throw $this->createAccessDeniedException("Tu ne peux pas acceder à cette ressource!");
    }
    return $this->render('galerie/show.html.twig', [
        'galerie'=> $galerie,
    ]);
}


    /**
     * @Route("/{id}/edit", name="app_galerie_edit", methods={"GET", "POST"},requirements={"id":"\d+"})
     */
    public function edit(Request $request, Galerie $galerie, GalerieRepository $galerieRepository): Response
    {
        $form = $this->createForm(GalerieType::class, $galerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $galerieRepository->add($galerie, true);

            return $this->redirectToRoute('app_galerie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('galerie/edit.html.twig', [
            'galerie' => $galerie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_galerie_delete", methods={"POST"},requirements={"id":"\d+"})
     */
    public function delete(Request $request, Galerie $galerie, GalerieRepository $galerieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$galerie->getId(), $request->request->get('_token'))) {
            $galerieRepository->remove($galerie, true);
        }

        return $this->redirectToRoute('app_galerie_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/new", name="app_galerie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, GalerieRepository $galerieRepository): Response
    {
        $galerie = new Galerie();
        $form = $this->createForm(GalerieType::class, $galerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $galerieRepository->add($galerie, true);
             // Make sure message will be displayed after redirect
         $this->addFlash('message', 'bien ajouté');
         // $this->addFlash() is equivalent to $request->getSession()->getFlashBag()->add()
         // or to $this->get('session')->getFlashBag()->add();


            return $this->redirectToRoute('app_galerie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('galerie/new.html.twig', [
            'galerie' => $galerie,
            'form' => $form,
        ]);
    }
    /**
 * @Route("/{galerie_id}/objet/{objet_id}", name="app_galerie_objet_show", methods={"GET"})
 * @ParamConverter("galerie", options={"id" = "galerie_id"})
 * @ParamConverter("objet", options={"id" = "objet_id"})
 */



public function objetShow(Galerie $galerie, Objet $objet): Response
{
    if(! $galerie->getObjet()->contains($objet)) {
        throw $this->createNotFoundException("Le vinyle que vous cherchez n'est pas dans la gallerie!");
    }

    if(! $galerie->isPubliee()) {
        throw $this->createAccessDeniedException("Cette galerie n'est pas publiée!");
    }
    

    return $this->render('galerie/objet_show.html.twig', [
        'objet' => $objet,
          'galerie' => $galerie
      ]);
}
     
    

}
