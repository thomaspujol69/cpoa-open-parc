<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BallBoyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $i0 = new \App\Entity\BallBoy();
        $i0->setName('Robert Duchmol');
        $manager->persist($i0);

        $i1 = new \App\Entity\BallBoy();
        $i1->setName('Alexandre Mathevon');
        $manager->persist($i1);

        $manager->flush();
    }
}
