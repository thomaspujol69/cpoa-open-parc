<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CourtFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $i0 = new \App\Entity\Court();
        $i0->setIsMain('');
        $i0->setName('Le Court Samuel Deschamps');
        $manager->persist($i0);

        $i1 = new \App\Entity\Court();
        $i1->setIsMain('');
        $i1->setName('Jean Eudes');
        $manager->persist($i1);

        $i2 = new \App\Entity\Court();
        $i2->setIsMain('1');
        $i2->setName('Destination Finale');
        $manager->persist($i2);

        $manager->flush();
    }
}
