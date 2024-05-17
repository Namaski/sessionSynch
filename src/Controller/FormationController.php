<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FormationController extends AbstractController
{
    // #[Route('/formation', name: 'app_formation')]
    // public function index(): Response
    // {
    //     return $this->render('formation/index.html.twig', [
    //         'controller_name' => 'FormationController',
    //     ]);
    // }

    #[Route('/formation', name: 'app_formation')]
    public function listFormations(FormationRepository $formationRepository): Response
    {

        $formations = $formationRepository->findAll();

        return $this->render('formation/index.html.twig', [
            'formations' => $formations,
        ]);
    }

    #[Route('/formation/{id}', name: 'show_formation')]
    public function show(Formation $formation): Response
    {

        return $this->render('formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }
}
