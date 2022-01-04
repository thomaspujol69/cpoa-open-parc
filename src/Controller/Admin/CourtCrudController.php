<?php

namespace App\Controller\Admin;

use App\Entity\Court;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CourtCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Court::class;
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
