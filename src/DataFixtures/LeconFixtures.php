<?php

namespace App\DataFixtures;

use App\Entity\Lecon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LeconFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = \Faker\Factory::create("fr_FR");
        for ($i = 0; $i < 10; $i++) {
            $lecon = new Lecon();
            $lecon->setNom($markdown->$faker->sentence)
                ->setDescription(join("\n\n**", $faker->paragraphs));

            $manager->persist($lecon);
        }

        $manager->flush();
    }



}
