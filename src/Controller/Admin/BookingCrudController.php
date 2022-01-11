<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EaysyAdminBundle\Field\Field;

class BookingCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
    {
        return Booking::class;
    }

  
public function configureFields(string $pageName): iterable
{
    return [
         Field::new('id'),
         Field::new('Date Booking'),
         Field::new('Hour Booking'),

         AssociationField::new('courts')
        ->setFormTypeOptions([
            'by_reference' => false,
        ])
    ];
}
  
}
