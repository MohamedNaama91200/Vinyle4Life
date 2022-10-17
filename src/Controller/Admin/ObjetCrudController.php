<?php

namespace App\Controller\Admin;

use App\Entity\Inventaire;
use App\Entity\Objet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\StringField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
class ObjetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Objet::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('Titre'),
            TextField::new('description'),
            IntegerField::new('Nb_de_tours'),
            BooleanField::new('Neuf'),
            IntegerField::new('Annee'),
            TextField::new('Album'),
            TextField::new('Duree'),
            AssociationField::new('inventaire'),
        ];
    }
    
}
