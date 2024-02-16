<?php

namespace App\DataFixtures;

use App\Entity\Lecon;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;
use function Sodium\add;

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
        $admin = new User();
        $admin->setLogin('admin')

            ->setPassword($this->passwordHasher->hashPassword(
                $admin,'secret'
            ))
            ->setRoles(['ROLE_ADMIN'])
            ->setNom('admin')
            ->setPrenom('admin');
        $professeur = new User();
        $professeur->setLogin('professeur')

            ->setPassword($this->passwordHasher->hashPassword(
                $professeur,'secret'
            ))
            ->setRoles(['ROLE_PROFESSEUR'])
            ->setNom('Dupont')
            ->setPrenom('Durand');

        $eleve = new User();
        $eleve->setLogin('eleve')

            ->setPassword($this->passwordHasher->hashPassword(
                $eleve,'secret'
            ))
            ->setRoles(['ROLE_ELEVE'])
            ->setNom('eleve')
            ->setPrenom('normal');


        $manager->persist($admin);
        $manager->persist($professeur);
        $manager->persist($eleve);



        for ($i = 0; $i < 10; $i++) {
            $lecon = new Lecon();
            $participants = new ArrayCollection();
            $lecon->setNom($faker->sentence)
                ->setDescription(join("\n\n**", $faker->paragraphs))
                ->setProfesseur($professeur)
                ->setParticipants($participants);


            $manager->persist($lecon);

        }

        $manager->flush();
    }



}
