<?php

namespace App\Controller\Admin;


use App\Entity\Galerie;
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

class GalerieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
    return Galerie::class;
    }

    public function configureFields(string $pageName): iterable
    {

    return [
        IdField::new('id')->hideOnForm(),
        AssociationField::new('creator'),
        BooleanField::new('publiee')
        ->onlyOnForms()
        ->hideWhenCreating(),
        TextField::new('description'),
        AssociationField::new('objet')
        ->onlyOnDetail()
        ->setTemplatePath('admin/fields/galerie_objet.html.twig')     
        /*->onlyOnForms()
        // on ne souhaite pas gérer l'association entre les
        // [objets] et la [galerie] dès la crétion de la
        // [galerie]
        ->hideWhenCreating()
        ->setTemplatePath('admin/fields/inventaire_objet.html.twig')
        // Ajout possible seulement pour des [objets] qui
        // appartiennent même propriétaire de l'[inventaire]
        // que le [createur] de la [galerie]
        ->setQueryBuilder(
            function (QueryBuilder $queryBuilder) {
            // récupération de l'instance courante de [galerie]
            $currentGalerie = $this->getContext()->getEntity()->getInstance();
            $createur = $currentGalerie->getCreateur();
            $memberId = $createur->getId();
            // charge les seuls [objets] dont le 'owner' de l'[inventaire] est le [createur] de la galerie
            $queryBuilder->leftJoin('entity.inventaire', 'i')
                ->leftJoin('i.owner', 'm')
                ->andWhere('m.id = :member_id')
                ->setParameter('member_id', $memberId);    
            return $queryBuilder;
            }
           ),
    ]; */ ] ; }
    
    public function configureActions(Actions $actions): Actions
    {
        // For whatever reason show isn't in the menu, bu default
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }

}