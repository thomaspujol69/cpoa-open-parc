<?php

namespace PromoCodeCrudController;

use App\Entity\PromoCode;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PromoCodeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PromoCode::class;
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
