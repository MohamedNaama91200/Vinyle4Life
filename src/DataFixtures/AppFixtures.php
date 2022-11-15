<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Repository\InventaireRepository;
use App\Repository\ObjetRepository;
use app\Entity\Objet;
use app\Entity\Inventaire;
use app\Entity\Galerie;

use app\Entity\Membre;
use app\Entity\Format;
use app\Entity\Style;
use app\Repository\MembreRepository;














class AppFixtures extends Fixture
{
    // définit un nom de référence pour une instance de Region
    public const Inventaire_I = 'Inventaire de Imad';
    public const FormatLP = 'LP';
    public const FormatEP = 'EP';
    public const FormatSP = 'SP';
    public const Rock = 'Rock';
    public const Pop = 'Pop';
    public const Rap = 'Rap';






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
        
        $album->setDescription("très bon album");
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
        $album->setinventaire($this->getReference(self::Inventaire_I));  

        $manager->persist($album);
        $manager->flush();

      /*  $inventaire->addobjet($album);
        $manager->persist($inventaire);
        $manager->flush(); */
        
        
        $imad = new Membre();
        $imad->setname("Imad");
        $imad->setDescription("Membre très actif");
        $manager->persist($imad);
        $manager->flush();
        
       $lp = new Format();
       $lp->setLabel("LP");
       $lp->setDescription("Vinyle LP");
       $manager->persist($lp);
       $manager->flush();
       
       $sp = new Format();
       $sp->setLabel("SP");
       $sp->setDescription("Vinyle SP");
       $manager->persist($sp);
       $manager->flush();
       

       $ep = new Format();
       $ep->setLabel("EP");
       $ep->setDescription("Vinyle EP");
       $manager->persist($ep);
       $manager->flush();
       
       $format = new Format();
       
       $format->setLabel("Format");
       $format->setDescription("Format");
       $format->addSubFormat1($lp);
       $format->addSubFormat1($sp);
       $format->addSubFormat1($ep);
       $manager->persist($format);
       $manager->flush();
       
       $rap = new Style();
       $rap->setLabel("Rap");
       $rap->setDescription("Style de musique : Rap");
       $manager->persist($rap);
       $manager->flush();
       
       $rock = new Style("Rock");
       $rock->setLabel("Rock");
       $rock->setDescription("Musique : Rock");
       $manager->persist($rock);
       $manager->flush();
       
       
       $style = new Style();

       $style->setLabel("Style");
       $style->setDescription("Style");
       $style->addSubStyle($rap);
       $style->addSubStyle($rock);
       $manager->persist($style);
       $manager->flush();
       
       $album->addStyle($rap);
       $album->addFormat($lp);

       $manager->persist($album);
       $manager->flush();

       $galerie = new Galerie();
       $galerie->setpubliee(True);
       $galerie->setDescription("Ma collec' de Vinyles");
       $galerie->addCreateur($imad);
       $galerie->addObjet($album);

       $manager->persist($galerie);
       $manager->flush();










        
        


        




        // ...


        //..
    }

    //...
}
