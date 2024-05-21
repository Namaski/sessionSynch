<?php

namespace App\Controller;

use App\Entity\Course;
use App\Form\CourseType;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/course/new', name: 'new_course')]
    #[Route('/course/{id}/edit', name: 'edit_course')]
    public function new_edit(Course $course = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$course) {
            $course = new Course();
        }

        $form = $this->createForm(CourseType::class, $course);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $course = $form->getData();
            // prepare PDO
            $entityManager->persist($course);
            // execute PDO
            $entityManager->flush();

            return $this->redirectToRoute('app_course');
        }
        return $this->render('course/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/course/{id}/delete', name: 'delete_course')]
    public function delete(Course $course, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($course);
        $entityManager->flush();
        return $this->redirectToRoute('app_course');;
    }

    #[Route('/course/{id}', name: 'show_course')]
    public function show(Course $course): Response
    {
        return $this->render('course/show.html.twig', [
            'course' => $course,
        ]);
    }


}
