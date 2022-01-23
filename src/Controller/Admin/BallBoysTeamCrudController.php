<?php

namespace App\Controller\Admin;

use App\Entity\BallBoysTeam;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class BallBoysTeamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BallBoysTeam::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('ballBoys')
            ->setFormTypeOptions([
                'by_reference' => false
            ])
        ];
    }
    
}
