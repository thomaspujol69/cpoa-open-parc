<?php

namespace App\Controller\Admin;

use App\Entity\BallBoy;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BallBoyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BallBoy::class;
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
