<?php


namespace App\Controller;

use App\Entity\Inventaire;
use App\Form\InventaireType;
use App\Repository\InventaireRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class InventaireController extends AbstractController
{ 

    /**
     * @Route("/", name = "home", methods="GET")
     */
    public function indexAction()
    {
        
        return $this->render('index.html.twig',
            [ 'welcome' => "Bienvenue sur Vinyle4Life : le site pour les collectionneurs de vinyles !" ]
        );
    }
    /**
     * @Route("/inventaire", name="app_inventaire")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(InventaireRepository $inventaireRepository): Response
{
    if ($this->isGranted('ROLE_ADMIN')) {
        return $this->render('inventaire/index.html.twig', [
            'inventaire' => $inventaireRepository->findAll(),
        ]);
    }
    else {
        $membre = $this->getUser()->getMembre();
        $inventaire = $membre->getNom();
        return $this->render('inventaire/index.html.twig', [
            'inventaire' => $inventaire
        ]);
    }
    

}
    

    public function listAction(ManagerRegistry $doctrine)
    { 
       
       
       
        $entityManager= $doctrine->getManager();
        $inventaire = $entityManager->getRepository(Inventaire::class)->findAll();
    
        dump($inventaire);
    
        return $this->render('inventaire/index.html.twig',
            [ 'inventaire' => $inventaire ]
            );
        
    }


    /**
 * Show a inventaire
 * 
 * @Route("/inventaire/{id}", name="inventaire_show", requirements={"id"="\d+"})
 *    note that the id must be an integer, above
 *    
 * @param Integer $id
 */
public function showAction(Inventaire $inventaire): Response
 {
     
    $hasAccess = $this->isGranted('ROLE_ADMIN') ||
    ($this->getUser()->getMembre() == $inventaire->getMembre());
    if(! $hasAccess) {
    throw $this->createAccessDeniedException("Vous ne pouvez pas accéder l'inventaire de " . $inventaire->getMembre());
}
    return $this->render('inventaire/show.html.twig',
     [ 'inventaire' => $inventaire ]
     );
 }
 /**
 * @Route("/new/{id}", name="app_inventaire_new", methods={"GET", "POST"}, requirements={"id"="\d+"})
 */
public function new(Request $request, InventaireRepository $inventaireRepository): Response
    {
        $inventaire = new Inventaire();
        $form = $this->createForm(InventaireType::class, $inventaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inventaireRepository->add($inventaire, true);
             // Make sure message will be displayed after redirect
         $this->addFlash('message', 'bien ajouté');
         // $this->addFlash() is equivalent to $request->getSession()->getFlashBag()->add()
         // or to $this->get('session')->getFlashBag()->add();


            return $this->redirectToRoute('app_inventaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inventaire/new.html.twig', [
            'inventaire' => $inventaire,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/{id}/edit", name="app_inventaire_edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Inventaire $inventaire, InventaireRepository $inventaireRepository): Response
    {
        $form = $this->createForm(InventaireType::class, $inventaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inventaireRepository->add($inventaire, true);

            return $this->redirectToRoute('app_inventaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inventaire/edit.html.twig', [
            'inventaire' => $inventaire,
            'form' => $form,
        ]);
    }
}

