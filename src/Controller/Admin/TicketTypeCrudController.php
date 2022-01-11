<?php

namespace TicketTypeCrudController;

use App\Entity\TicketType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TicketTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TicketType::class;
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
