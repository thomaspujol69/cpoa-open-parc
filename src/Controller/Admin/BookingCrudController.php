<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

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
         Field::new('dateBooking'),
         Field::new('hourBooking'),

         AssociationField::new('court')
        ->setFormTypeOptions([
            'by_reference' => false
        ])
    ];
}
  
}
