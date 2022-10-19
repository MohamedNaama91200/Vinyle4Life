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
/*use EasyCorp\Bundle\EasyAdminBundle\Field\StringField;*/
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;



class InventaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Inventaire::class;
    }

    
    
    public function configureFields(string $pageName): iterable {
        dump("toto");
        return [
            // Id shouldn't be modified
            IdField::new('id')->hideOnForm(),
            // Completed configureFieldswill be rendered as a toggle only in edit
         // Title will be rendered so as to include a link, and be striked whenever completed
            TextField::new('Titre'),
            AssociationField::new('objet')
            ->onlyOnDetail()
            ->setTemplatePath('admin/fields/inventaire_objet.html.twig')      
         ];
    } 
    
    public function configureActions(Actions $actions): Actions
    {
        // For whatever reason show isn't in the menu, bu default
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }

    
    
}
