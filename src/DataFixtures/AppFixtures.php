<?php

namespace App\DataFixtures;

use App\Entity\Family;
use App\Entity\Discipline;
use App\Entity\Skill;
use App\Entity\Level;
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
            $family->setTitleEn($faker->jobTitle);
            $family->setTitleFr($faker->jobTitle);
            $family->setDescriptionEn($faker->text);
            $family->setDescriptionFr($faker->text);
            $family->setStatus(1);
            $family->setDateCreated((\DateTime::createFromFormat('Y-m-d', date('Y-m-d'))));
            $manager->persist($family);
        }
        for ($i = 0; $i < 10; $i++) {
            $discipline = new Discipline();
            $discipline->setTitleEn($faker->jobTitle);
            $discipline->setTitleFr($faker->jobTitle);
            $discipline->setDescriptionEn($faker->text);
            $discipline->setDescriptionFr($faker->text);
            $discipline->setStatus(1);
            $discipline->setGrade(array(1, 2));
            $discipline->setFamily($family);
            $discipline->setDateCreated((\DateTime::createFromFormat('Y-m-d', date('Y-m-d'))));
            $manager->persist($discipline);
        }
        for ($i = 0; $i < 10; $i++) {
            $skill = new Skill();
            $skill->setTitleEn($faker->jobTitle);
            $skill->setTitleFr($faker->jobTitle);
            $skill->setDescriptionEn($faker->text);
            $skill->setDescriptionFr($faker->text);
            $skill->setStatus(1);
            $skill->setSkilltype('T');
            $skill->setDateCreated((\DateTime::createFromFormat('Y-m-d', date('Y-m-d'))));
            $manager->persist($skill);
            for ($j = 1; $j <= 5; $j++) {
                $level = new Level();
                $level->setTitleEn($faker->jobTitle);
                $level->setTitleFr($faker->jobTitle);
                $level->setDescriptionEn($faker->text);
                $level->setDescriptionFr($faker->text);
                $level->setGrade($j);
                $level->setSkill($skill);
                $manager->persist($level);
            }
        }


        $manager->flush();
    }
}
