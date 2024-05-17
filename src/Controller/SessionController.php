<?php

namespace App\Controller;

use App\Entity\Session;
use App\Repository\SessionRepository;
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

        $sessions = $sessionRepository->findAll();

        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }

    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session ): Response
    {

        
    //    var_dump($this); die;
        return $this->render('session/show.html.twig', [
            'session' => $session
        ]);
    }

}
