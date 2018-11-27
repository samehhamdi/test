<?php

namespace App\DataFixtures;
use App\Entity\Family;
use App\Entity\Discipline;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $family = new Family();
            $family->setTitle($faker->jobTitle);
            $family->setDescription($faker->text);
            $family->setStatus(1);
            $family->setDateCreated((\DateTime::createFromFormat('Y-m-d', date('Y-m-d'))));
            $manager->persist($family);
        }
        for ($i = 0; $i < 10; $i++) {
            $discipline = new Discipline();
            $discipline->setTitle($faker->jobTitle);
            $discipline->setDescription($faker->text);
            $discipline->setStatus(1);
            $discipline->setGrade(array(1,2));
            $discipline->setFamily($family);
            $discipline->setDateCreated((\DateTime::createFromFormat('Y-m-d', date('Y-m-d'))));
            $manager->persist($discipline);
        }

        $manager->flush();
    }
}
