<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;

use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $factory = new PasswordHasherFactory([
            'common' => ['algorithm' => 'bcrypt'],
            'memory-hard' => ['algorithm' => 'sodium'],
        ]);
        $passwordHasher = $factory->getPasswordHasher('common');
        
        $u = new User();
        $u->setEmail("cpoa-admin@yopmail.com");
        $u->setRoles(["ROLE_ADMIN"]);
        $u->setPassword(
            $passwordHasher->hash("azertyuiop")
        );
        $u->setFirstName("AdminF");
        $u->setLastName("AdminL");

        $manager->persist($u);
        $manager->flush();
    }
}
