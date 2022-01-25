<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class BookingCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
    {
        return Booking::class;
    }

  
public function configureFields(string $pageName): iterable
{
    return [
         Field::new('dateBooking'),
         ChoiceField::new('hourBooking')->setChoices([
            '10:00' => '10:00',
            '12:00' => '12:00',
            '14:00' => '14:00',
            '16:00' => '16:00'
        ]),

         AssociationField::new('court')
        ->setFormTypeOptions([
            'by_reference' => false
        ]),

        AssociationField::new('player')
        ->setFormTypeOptions([
            'by_reference' => false
        ])
    ];
}
  
}
