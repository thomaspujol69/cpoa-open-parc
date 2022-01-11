<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookingCrudController extends AbstractCrudController
{
  /*  public static function getEntityFqcn(): string
    {
        return Booking::class;
    }
*/
  
public function configureFields(string $pageName): iterable
{
    return [
        yield IdField::new('id'),
        yield DateTimeField::new('Date Booking'),
        yield TextField::new('Hour Booking'),

        yield AssociationField::new('courts')
        ->setFormTypeOptions([
            'by_reference' => false,
        ])
    ];
}
  
}
