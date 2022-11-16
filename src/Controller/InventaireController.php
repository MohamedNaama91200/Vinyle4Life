<?php


namespace App\Controller;

use App\Entity\Inventaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class InventaireController extends AbstractController
{ 

    /**
     * @Route("/", name = "home", methods="GET")
     */
    public function indexAction1()
    {
        $htmlpage = '<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Vinyle4Life</title>
    </head>
    <body>
        <h1>Bienvenue !</h1>
                <p> <img src="./channels4_profile.jpg" /> </p>  
    <p>Bienvenue sur Vinyle4Life : le site pour les collectionneurs de vinyles !</p>
    </body>
</html>';
        
        return new Response(
            $htmlpage,
            Response::HTTP_OK,
            array('content-type' => 'text/html')
            );
    }
    /**
     * @Route("/inventaire", name="app_inventaire")
     */
    
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
     return $this->render('inventaire/show.html.twig',
     [ 'inventaire' => $inventaire ]
     );
 }
 /**
 * @Route("/new/{id}", name="app_inventaire_new", methods={"GET", "POST"}, requirements={"id"="\d+"})
 */
public function new(Request $request, InventaireRepository $inventaireRepository, Membre $membre): Response
{
    $inventaire = new Inventaire();
    $inventaire->setMembre($membre);


    

}
}

