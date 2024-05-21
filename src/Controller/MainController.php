<?php

namespace App\Controller;

use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/session', name: 'app_main')]
    public function index(SessionRepository $sessionRepository): Response
    {
        $events = $sessionRepository->findAll();

        $rdvs = [];
        foreach($events as $event){
            $rdvs[] = [
                'title' => $event->getSessionName(),
                'id' => $event->getId(),
                'start' => $event->getStartDate()->format('Y-m-d H:i:s'),
                'end' => $event->getEndDate()->format('Y-m-d H:i:s'),
            ];
        }
        
        // dd($rdvs);
        $data = json_encode($rdvs);
        
        return $this->render('session/index.html.twig', compact('data'));
    }
}
