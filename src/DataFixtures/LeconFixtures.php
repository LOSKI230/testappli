<?php

namespace App\DataFixtures;

use App\Entity\Lecon;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class LeconFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");
        // un user
        $user = new User();
        $user->setLogin('admin')

            ->setPassword($this->passwordHasher->hashPassword(
                $user,'secret'
            ))
            ->setRoles(['ROLE_PROFESSEUR'])
            ->setNom('toto')
            ->setPrenom('tata');


        $manager->persist($user);

     
        for ($i = 0; $i < 10; $i++) {
            $lecon = new Lecon();
            $lecon->setNom($faker->sentence)
                ->setDescription(join("\n\n**", $faker->paragraphs))
              ->setProfesseur($user);

            $manager->persist($lecon);
        }

        $manager->flush();
    }



}
