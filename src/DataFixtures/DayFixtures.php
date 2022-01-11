<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Day;

class DayFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=15; $i<22; $i++){
            $d = new Day();
            $d->setDate(new \DateTime("2022-05-".strval($i)));
            $t = new \DateTime();
            $t->setTime(10, 0, 0);
            $d->setBegining($t);
            $d->setDescription("Organisateur : ALLIN EVENT");
            $manager->persist($d);
        }
        $manager->flush();
    }
}