<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $i0 = new \App\Entity\Player();
        $i0->setNationality('Serbe');
        $i0->setFirstName('Vincent');
        $i0->setLastName('Luisetti');
        $i0->setIsWomen(false);
        $manager->persist($i0);
        
        $i1 = new \App\Entity\Player();
        $i1->setNationality('Croatien');
        $i1->setFirstName('Thomas');
        $i1->setLastName('Daneyrolle');
        $i1->setIsWomen(false);
        $manager->persist($i1);
        
        $i2 = new \App\Entity\Player();
        $i2->setNationality('Brittanique');
        $i2->setFirstName('Martin');
        $i2->setLastName('Aston');
        $i2->setIsWomen(false);
        $manager->persist($i2);
        
        $i3 = new \App\Entity\Player();
        $i3->setNationality('Congolais');
        $i3->setFirstName('PasseMuraille');
        $i3->setLastName('FelindraTeteDeTigre');
        $i3->setIsWomen(false);
        $manager->persist($i3);
        
        $manager->flush();
    }
}
