<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $User = new User();
        $User->setEmail('artem');
        $User->setPassword('$2y$13$lUU6iitiAmATddlzylzBaO143DSPuG.EDTEsVjW94XlaGAunNP3Ve');
        $manager->persist($User);

        $manager->flush();
    }
}
