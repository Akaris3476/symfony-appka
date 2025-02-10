<?php

namespace App\DataFixtures;

use App\Entity\InformationAboutMe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AboutMeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $AboutMe = new InformationAboutMe();
        $AboutMe->setKey('name');
        $AboutMe->setValue('Artem');
        $manager->persist($AboutMe);

        $AboutMe = new InformationAboutMe();
        $AboutMe->setKey('age');
        $AboutMe->setValue('18');
        $manager->persist($AboutMe);

        $AboutMe = new InformationAboutMe();
        $AboutMe->setKey('heigth');
        $AboutMe->setValue('unknown');
        $manager->persist($AboutMe);


        $manager->flush();
    }
}
