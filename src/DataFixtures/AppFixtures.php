<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Repository\InventaireRepository;
use App\Repository\ObjetRepository;
use app\Entity\Objet;
use app\Entity\Inventaire;
use app\Entity\Galerie;
use app\Entity\User;
use app\Entity\UserRepository;
use App\Repository\GalerieRepository;


use app\Entity\Membre;
use app\Entity\Format;
use app\Entity\Style;
use app\Repository\MembreRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;













class AppFixtures extends Fixture implements DependentFixtureInterface
{
    // définit un nom de référence pour une instance de Region
    public const Inventaire_I = 'Inventaire de Imad';
    public const FormatLP = 'LP';
    public const FormatEP = 'EP';
    public const FormatSP = 'SP';
    public const Rock = 'Rock';
    public const Pop = 'Pop';
    public const Rap = 'Rap';

    private function MembreDataGenerator()
    {
        // todo = [title, completed];
        yield ['mohamed', 'mohamed@localhost'];
        
        yield['chris','chris@localhost'];

        yield['imad', 'imad@localhost'];
    }






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
        $imad->addNom($inventaire);
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
       $galerie->addObjet($album);

       $manager->persist($galerie);
       $manager->flush();

       $alum = new Objet();
        
       $alum->setDescription("très mauvais ");
       $alum->setTitre("En Y");
       $alum->setNbDeTours(33);
       $alum->setNeuf(True);
       $alum->setAnnee(2015);
       $alum->setAlbum("My World");
       $alum->setDuree("2m04");

       $manager->persist($alum);
       $manager->flush();

     
      
       
        $mohamed = new Membre();
        $user = $manager->getRepository(User::class)->findOneByEmail('mohamed@localhost');
        $mohamed->setUser($user);
        $mohamed->setName('mohamed');
        $mohamed->setDescription('mohamed');
        $user->setMembre($mohamed);

        $chris = new Membre();
        $userc = $manager->getRepository(User::class)->findOneByEmail('chris@localhost');
        $chris->setUser($userc);
        $chris->setName('chris');
        $chris->setDescription('chris');
        $userc->setMembre($chris);


       
        
        $manager->persist($mohamed);
        $manager->flush();

        $manager->persist($user);
        $manager->flush();


        
        $manager->persist($mohamed);
        $manager->flush();

        $manager->persist($userc);
        $manager->flush();



      
     // $mohameduser = $manager->getRepository(Membre::class)->findOneByName('mohamed');

      $galerie->setCreator($mohamed);


      $manager->persist($galerie);
      $manager->flush();
      
      $usimad = $manager->getRepository(User::class)->findOneByEmail('imad@localhost');
      $imad->setUser($usimad);
      $usimad->setMembre($imad);

      $manager->persist($imad);
      $manager->flush();
      

      $manager->persist($usimad);
      $manager->flush();


      $g = new Galerie();
      $g->setpubliee(False);
      $g->setDescription("Pour les fans de Rap !");
      $g->addObjet($alum);
      $g->addObjet($album);
      $g->setCreator($imad);

      
      

      $manager->persist($g);
      $manager->flush();

      $imad->addShowroom($g);

      $manager->persist($imad);
      $manager->flush();
      $mohamed->addShowroom($galerie);

      $manager->persist($mohamed);
      $manager->flush();


      $ga = new Galerie();
      $ga->setpubliee(True);
      $ga->setDescription("Les pires sons !");
      $ga->addObjet($alum);
      $ga->addObjet($album);
      $ga->setCreator($imad);   
    
      $manager->persist($ga);
      $manager->flush(); 


      $i = new Inventaire();
      $i->setTitre("Inventaire de Momo");
      $i->addobjet($alum);
      $manager->persist($i);
      $manager->flush(); 

      $mohamed->addNom($i);
      

      $manager->persist($mohamed);
      $manager->flush(); 

      $aya = new Objet();
        
      $aya->setDescription("De l'art ! ");
      $aya->setTitre("Djaja");
      $aya->setNbDeTours(33);
      $aya->setNeuf(True);
      $aya->setAnnee(2018);
      $aya->setAlbum("NAKAMURA");
      $aya->setDuree("2m55");

      $manager->persist($aya);
      $manager->flush(); 

      $galerie->addObjet($aya);

      $manager->persist($galerie);
      $manager->flush(); 

      

     
}






        
        


        




        // ...


        //..
    

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
    
  

    //...
}
