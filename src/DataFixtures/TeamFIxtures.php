<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeamFIxtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $i0 = new \App\Entity\Team();
        $manager->persist($i0);
        
        $i1 = new \App\Entity\Team();
        $manager->persist($i1);
        
        $manager->flush();
    }
}
