<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class GameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Game::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('isFinal'),
            Field::new('isDouble'),
            Field::new('date'),
            Field::new('hour'),
            Field::new('score'),

            AssociationField::new('chairArbitrator')
            ->setFormTypeOptions([
                'by_reference' => true
            ]),
            AssociationField::new('lineArbitrators')
            ->setFormTypeOptions([
                'by_reference' => false
            ]),
            AssociationField::new('ballBoys')
            ->setFormTypeOptions([
                'by_reference' => false
            ]),
            AssociationField::new('players')
            ->setFormTypeOptions([
                'by_reference' => false
            ]),
            AssociationField::new('court')
            ->setFormTypeOptions([
                'by_reference' => true
            ]),
            AssociationField::new('teams')
            ->setFormTypeOptions([
                'by_reference' => false
            ])
        ];
    }
    
}
