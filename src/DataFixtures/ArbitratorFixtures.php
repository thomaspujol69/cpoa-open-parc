<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArbitratorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $i0 = new \App\Entity\Arbitrator();
        $i0->setName('Thomas Daneyrolle');
        $i0->setNbSimpleMatchs('0');
        $i0->setNbDoubleMatchs('0');
        $i0->setNationality('Roumain');
        $manager->persist($i0);

        $i1 = new \App\Entity\Arbitrator();
        $i1->setName('Lucas Lenoir');
        $i1->setNbSimpleMatchs('0');
        $i1->setNbDoubleMatchs('0');
        $i1->setNationality('Sénégalais');
        $manager->persist($i1);

        $i2 = new \App\Entity\Arbitrator();
        $i2->setName('Maxime Peloutier');
        $i2->setNbSimpleMatchs('0');
        $i2->setNbDoubleMatchs('0');
        $i2->setNationality('Brésilien');
        $manager->persist($i2);

        $manager->flush();
    }
}
