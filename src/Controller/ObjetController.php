<?php

namespace App\Controller;

use App\Entity\Objet;
use App\Form\ObjetType;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\ObjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
/**
 * 
 * @Route("/objet")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class ObjetController extends AbstractController
{
   /**
 * @Route("/", name="app_objet_index", methods={"GET"})
 */
public function index(ObjetRepository $objetRepository): Response
{
    if ($this->isGranted('ROLE_ADMIN')) {

    return $this->render('objet/index.html.twig', [
        'objet' => $objetRepository->findAll(),
    ]);
    }
    else {
        $membre = $this->getUser()->getMembre();
        $objet = $objetRepository->findMembreObjet($membre);

    return $this->render('objet/index.html.twig', [
        'objet' => $objet
    ]);
    }

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
        /**
 * Mark a task as current priority in the user's session
 * 
 * @Route("/mark/{id}", name="objet_mark", requirements={ "id": "\d+"}, methods="GET")
 */
public function markAction(Request $request, Objet $objet): Response
{
    
         // ...
    
         // Récupération du tableau d'id urgents dans la session
         $urgents = $request->getSession()->get('urgents');
         $id = $objet->getID('id');
         // si l'identifiant n'est pas présent dans le tableau des urgents, l'ajouter
         if (! is_array($urgents) ) 
         {
              $urgents[] = $id;

                                   }

        if (! in_array($id, $urgents) ) 
{
    $urgents[] = $id;
}
        else
// sinon, le retirer du tableau
{
    $urgents = array_diff($urgents, array($id));
}
         

    
         // ...
    
         // Sauvegarde du tableau d'id urgents dans la session
         $request->getSession()->set('urgents', $urgents);

       dump($objet);
        return $this->redirectToRoute('app_objet_show', 
        ['id' => $objet->getId()]);
    
         // ...
        }

   
    /**
     * @Route("/panier", name="objet_panier", methods="GET")
     */
    public function panier(ObjetRepository $objetRepository): Response
    {
        return $this->render('objet/panier.html.twig', [
            'objet' => $objetRepository->findAll(),
        ]);
    }


    
}
