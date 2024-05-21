<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    // #[Route('/session', name: 'app_session')]
    // public function index(): Response
    // {
    //     return $this->render('session/index.html.twig', [
    //         'controller_name' => 'SessionController',
    //     ]);
    // }
    #[Route('/session', name: 'app_session')]
    public function listSession(SessionRepository $sessionRepository): Response
    {

        return $this->render('session/index.html.twig', [
            'calendars' => $sessionRepository->findAll(),
        ]);
    }

    #[Route('/session/new', name: 'new_session')]
    #[Route('/session/{id}/edit', name: 'edit_session')]
    public function new_edit(Session $session = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$session) {
            $session = new Session();
        }

        $form = $this->createForm(SessionType::class, $session);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $session = $form->getData();
            // prepare PDO
            $entityManager->persist($session);
            // execute PDO
            $entityManager->flush();

            return $this->redirectToRoute('app_session');
        }
        return $this->render('session/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/session/{id}/delete', name: 'delete_session')]
    public function delete(Session $session, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($session);
        $entityManager->flush();
        return $this->redirectToRoute('app_session');;
    }

    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session): Response
    {


        return $this->render('session/show.html.twig', [
            'session' => $session
        ]);
    }
}
