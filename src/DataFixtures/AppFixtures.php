<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Repository\InventaireRepository;
use App\Repository\ObjetRepository;
use app\Entity\Objet;
use app\Entity\Inventaire;














class AppFixtures extends Fixture
{
    // définit un nom de référence pour une instance de Region
    public const Inventaire_I = 'Inventaire de Imad';

    public function load(ObjectManager $manager)
    {


        $inventaire = new Inventaire();
        $inventaire->setTitre("Inventaire de Imad");
        
        $manager->persist($inventaire);

        $manager->flush();
        // Une fois l'instance de Region sauvée en base de données,
        // elle dispose d'un identifiant généré par Doctrine, et peut
        // donc être sauvegardée comme future référence.
        $this->addReference(self::Inventaire_I, $inventaire);

        // ...

        $album = new Objet();
        
        $album->setdescription("très bon album");
        $album->setTitre("La Kiffance");
        $album->setNbDeTours(33);
        $album->setNeuf(True);
        $album->setAnnee(1999);
        $album->setAlbum("Les mains faites pour l'or");
        $album->setDuree("3m04");
        
        

        //$room->addRegion($region);
        // On peut plutôt faire une référence explicite à la référence
        // enregistrée précédamment, ce qui permet d'éviter de se
        // tromper d'instance de Region :
        $album->setInventaire($this->getReference(self::Inventaire_I));   
        $manager->persist($album);
        $manager->flush();

        




        // ...


        //..
    }

    //...
}
