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
    
    public function indexAction(ManagerRegistry $doctrine)

    {
        
        $res = '<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset="UTF-8">
                            <title>Inventaire de vinyles</title>
                        </head>
                        <body>
                            <h1>Collection De Vinyles</h1>

                        <p>Here are all the public collection :</p>
                        <ul>
                           ... Premier inventaire...
                        </ul>
                        </body>
                    </html>';
        

        return new Response(
            $res,
            Response::HTTP_OK,
            array('content-type' => 'text/html')
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
/*
$entityManager= $doctrine->getManager();
$inventaires = $entityManager->getRepository(Inventaire::class)->findAll();
foreach($inventaires as $inventair) {
   $res .= '<li>
    <a href="/inventaire/"> Ceci est l_inventaire "' .$id'"';
 }
 */

public function show(ManagerRegistry $doctrine, $id)
{
    $inventaireRepo = $doctrine->getRepository(Inventaire::class);
    $inventaire = $inventaireRepo->find($id);

    if (!$inventaire) {
        throw $this->createNotFoundException('The inventaire does not exist');
    }
    
    $url = $this->generateUrl('inventaire_show', ['id' => $inventaire->getId()]);
    $res = '<!DOCTYPE html>
    <html>
    <body>Liste des inventaires :
      
      <ul>
      <li><a href="' .$url. '">Ceci est l_inventaire de "' .$id. '" </a></li>
       
      </ul>
    </body>
  </html>
  ';


    

    $res .= '<p/><a href="' . $this->generateUrl('app_inventaire') . '">Back</a>';

    return new Response('<html><body>'. $res . '</body></html>');
}

}

