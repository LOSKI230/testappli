<?php

namespace App\Controller;

use App\Entity\Lecon;
use App\Entity\User;
use App\Form\LeconType;
use App\Form\RegistrationFormType;
use App\Repository\LeconRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use PHPUnit\Util\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('IS_AUTHENTICATED_FULLY')]
class ProfesseurController extends AbstractController
{
    #[Route('/gerer', name: 'app_gerer_professeur', methods: ['GET'])]
    public function index(Request $request,UserRepository $userRepository,PaginatorInterface $paginator): Response
    {
        $listeusers = $userRepository->findUsers('ROLE_PROFESSEUR');

        return $this->render('professeur/afficher.html.twig', [
            'professeurs' => $listeusers,
             'erreur'=> ''
        ]);
    }
    #[Route('/{id}/supprimer', name: 'app_professeur_supprimer', methods: ['GET'])]
    public function supprimerProfesseur($id,Request $request,EntityManagerInterface $entityManager,UserRepository $userRepository,PaginatorInterface $paginator): Response
    {
        $user = $userRepository->findOneBy(['id' => $id ]);
        $listeusers = $userRepository->findUsers('ROLE_PROFESSEUR');
        $lecons = $user->getLecons();
         if($lecons){
             return $this->render('professeur/afficher.html.twig', [
                  'professeurs' => $listeusers,
                  'erreur' => "Supprimer d'abord les leçons de ce professeur"
             ]);
         }
        $entityManager->remove($user);
        $entityManager->flush();
        $listeusersupdate = $userRepository->findUsers('ROLE_PROFESSEUR');
        return $this->render('professeur/afficher.html.twig', [
            'professeurs' => $listeusersupdate,
            'erreur'=>''
        ]);
    }
    #[Route('/{id}/changerole', name: 'app_professeur_role', methods: ['GET'])]
    public function changerRole($id,Request $request,UserRepository $userRepository,PaginatorInterface $paginatorn,EntityManagerInterface  $entityManager ): Response
    {
        $user = $userRepository->findOneBy(['id' => $id ]);
        $user->setRoles(['ROLE_ADMIN','ROLE_PROFESSEUR']);
        $entityManager->persist($user);
        $entityManager->flush();
        $listeusers = $userRepository->findUsers('ROLE_PROFESSEUR');
        return $this->render('professeur/afficher.html.twig', [
            'professeurs' => $listeusers,
            'erreur'=> ''
        ]);
    }

    #[Route('/ajoutprof', name: 'app_ajouter_professeur')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            )
                ->setRoles(['ROLE_PROFESSEUR']);

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_lecon_index');
        }

        return $this->render('professeur/ajoutprof.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


}
