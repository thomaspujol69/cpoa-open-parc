<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\TicketType;

class TicketTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tt = new TicketType();
        $tt->setLabel("Categorie 1");
        $tt->setPrice(100); // pourcentage
        $manager->persist($tt);

        $tt = new TicketType();
        $tt->setLabel("Categorie 2");
        $manager->persist($tt);

        $tt = new TicketType();
        $tt->setLabel("Journée de la Solidarité");
        $manager->persist($tt);

        $tt = new TicketType();
        $tt->setLabel("The Big Match");
        $manager->persist($tt);

        $tt = new TicketType();
        $tt->setLabel("Licencié");
        $tt->setPrice(83);
        $manager->persist($tt);

        $manager->flush();
    }
}
