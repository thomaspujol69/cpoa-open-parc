<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

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
            AssociationField::new('day')
                ->setFormTypeOptions([
                    'by_reference' => true
                ]),
            ChoiceField::new('hour')->setChoices([
                '10:00' => '10:00',
                '12:00' => '12:00',
                '14:00' => '14:00',
                '16:00' => '16:00'
            ]),
            Field::new('score'),

            AssociationField::new('players')
            ->setFormTypeOptions([
                'by_reference' => false
            ]),
            AssociationField::new('teams')
            ->setFormTypeOptions([
                'by_reference' => false
            ]),
            AssociationField::new('chairArbitrator')
            ->setFormTypeOptions([
                'by_reference' => true
            ]),
            AssociationField::new('lineArbitrators')
            ->setFormTypeOptions([
                'by_reference' => false
            ]),
            AssociationField::new('ballBoysTeams')
            ->setFormTypeOptions([
                'by_reference' => false
            ]),
            
            AssociationField::new('court')
            ->setFormTypeOptions([
                'by_reference' => true
            ])
        ];
    }
    
}
