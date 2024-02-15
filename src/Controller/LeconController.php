<?php

namespace App\Controller;

use App\Entity\Lecon;
use App\Entity\User;
use App\Form\LeconType;
use App\Repository\LeconRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('IS_AUTHENTICATED_FULLY')]
#[Route('/lecon')]
class LeconController extends AbstractController
{
    #[Route('/', name: 'app_lecon_index', methods: ['GET'])]
    public function index(Request $request,LeconRepository $leconRepository,PaginatorInterface $paginator): Response
    {   $lecon =  $leconRepository->findAll();
        $user = $this->getUser();
        $pageslecons = $paginator->paginate(
            $lecon,
            $request->query->getInt('page',1),8
        );
        foreach ($lecon as $item){

            if($item->getParticipants()->contains($user)){
                $item->setStatut('Inscrit');
            };
        }
        return $this->render('lecon/index.html.twig', [
            'lecons' => $pageslecons,
        ]);
    }

    #[Route('/new', name: 'app_lecon_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lecon = new Lecon();
        $form = $this->createForm(LeconType::class, $lecon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user1 = $this->getUser();
            $lecon1 = new Lecon();
            $lecon1->setNom($lecon->getNom())
                ->setDescription($lecon->getDescription())
                ->setProfesseur($user1);

            $entityManager->persist($lecon1);
            $entityManager->flush();

            return $this->redirectToRoute('app_lecon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lecon/new.html.twig', [
            'lecon' => $lecon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lecon_show', methods: ['GET'])]
    public function show(Lecon $lecon): Response
    {
        $participants = $lecon->getParticipants();
        return $this->render('lecon/show.html.twig', [
            'lecon' => $lecon,
            'participants'=> $participants
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lecon_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lecon $lecon, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LeconType::class, $lecon);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lecon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lecon/edit.html.twig', [
            'lecon' => $lecon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lecon_delete', methods: ['POST'])]
    public function delete(Request $request, Lecon $lecon, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lecon->getId(), $request->request->get('_token'))) {
            $entityManager->remove($lecon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lecon_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}/inscription_lecon', name: 'app_lecon_inscription', methods: ['GET', 'POST'])]
    public function inscription_lecon(Request $request, Lecon $lecon, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();
        $lecon->addParticipants($user);
        $user->addInscriptions($lecon);
        $entityManager->persist($lecon);
        $entityManager->flush();
        $entityManager->persist($user);
        $entityManager->flush();


        return $this->redirectToRoute('app_lecon_index', [], Response::HTTP_SEE_OTHER);

    }
    #[Route('/{id}/desinscription_lecon', name: 'app_lecon_desinscription', methods: ['GET', 'POST'])]
    public function desinscription_lecon(Request $request, Lecon $lecon, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();
        $lecon->removeParticipants($user);
        $user->removeInscription($lecon);
        $entityManager->persist($lecon);
        $entityManager->flush();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_lecon_index', [], Response::HTTP_SEE_OTHER);

    }
    #[Route('/{id}/inscrit', name: 'app_lecon_show_mes_lecons', methods: ['GET', 'POST'])]

    public function showMesLecons(User $user): Response
    {
        $lecon = $user->getInscriptions();

        foreach ($lecon as $item){

            if($item->getParticipants()->contains($user)){
                $item->setStatut('Inscrit');
            };
        }
        return $this->render('lecon/show_mes_lecon.html.twig', [
            'user' => $user,
        ]);
    }

}
