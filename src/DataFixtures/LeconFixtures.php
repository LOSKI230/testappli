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
        $user = new User();
        $user->setLogin('admin')

            ->setPassword($this->passwordHasher->hashPassword(
                $user,'secret'
            ))
            ->setRoles(['ROLE_PROFESSEUR'])
            ->setNom('admin')
            ->setPrenom('toto');
        $user3 = new User();
        $user3->setLogin('admin2')

            ->setPassword($this->passwordHasher->hashPassword(
                $user3,'secret'
            ))
            ->setRoles(['ROLE_PROFESSEUR'])
            ->setNom('admin2')
            ->setPrenom('toto');

        $user2 = new User();
        $user2->setLogin('user')

            ->setPassword($this->passwordHasher->hashPassword(
                $user2,'secret'
            ))
            ->setRoles(['ROLE_USER'])
            ->setNom('user')
            ->setPrenom('normal');

        $manager->persist($user2);
        $manager->persist($user);
        $manager->persist($user3);


        for ($i = 0; $i < 10; $i++) {
            $lecon = new Lecon();
            $participants = new ArrayCollection();
            $participants->add($user);
            $lecon->setNom($faker->sentence)
                ->setDescription(join("\n\n**", $faker->paragraphs))
                ->setProfesseur($user)
                ->setParticipants($participants);


            $manager->persist($lecon);
        }

        $manager->flush();
    }



}
