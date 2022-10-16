<?php

namespace App\Controller\Admin;

use App\Entity\Inventaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InventaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Inventaire::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
