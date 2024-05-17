<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(SessionRepository $sessionRepository, FormationRepository $formationRepository): Response
    {
        $sessions = $sessionRepository->findBy([],[],3);

        $formations = $formationRepository->findBy([],[],3);

        
        return $this->render('home/index.html.twig', [
            'sessions' => $sessions,
            'formations' => $formations
        ]);
    }

}
