<?php

namespace App\Controller;

use App\Entity\Course;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    // #[Route('/course', name: 'app_course')]
    // public function index(): Response
    // {
    //     return $this->render('course/index.html.twig', [

    //     ]);
    // }

    #[Route('/course', name: 'app_course')]
    public function listCourse(CourseRepository $courseRepository): Response
    {

        $courses = $courseRepository->findAll();

        return $this->render('course/index.html.twig', [
            'courses' => $courses,
        ]);
    }

    #[Route('/course/{id}', name: 'show_course')]
    public function show(Course $course): Response
    {
        return $this->render('course/show.html.twig', [
            'course' => $course,
        ]);
    }


}
