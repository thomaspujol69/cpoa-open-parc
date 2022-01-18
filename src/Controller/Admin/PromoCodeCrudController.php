<?php

namespace App\Controller\Admin;

use App\Entity\PromoCode;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class PromoCodeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PromoCode::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('label'),
            Field::new('code'),

            AssociationField::new('ticketType')
            ->setFormTypeOptions([
            'by_reference' => false
        ])
        ];
    }
}
