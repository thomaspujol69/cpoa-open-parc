<?php

namespace App\Controller\Admin;

use App\Entity\Arbitrator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArbitratorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Arbitrator::class;
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
