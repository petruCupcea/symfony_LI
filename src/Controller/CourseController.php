<?php

namespace App\Controller;

use App\Entity\Course;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    #[Route('', name: 'courses.index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $courses = $doctrine->getRepository(Course::class)->findAll();

        return $this->render('courses/course-list.html.twig', [
            'courses' => $courses
        ]);
    }
    
    // Look in routes.yaml
    public function show(ManagerRegistry $doctrine, int $course): Response
    {
        $courseObject = $doctrine->getRepository(Course::class)->find($course);
        
        return $this->render('courses/course-show.html.twig', [
            'course' => $courseObject
        ]);
    }
    
    #[Route('/create', name: 'courses.create')]
    public function create(): Response
    {
        return $this->render('courses/course-add.html.twig', [
            
        ]);
    }

    #[Route('/{course}/store', name: 'courses.store', methods: ['POST'])]
    public function store()
    {
        // @todo add functionality
    }

    #[Route('/{course}/edit', name: 'courses.edit')]
    public function edit(): Response
    {
        return $this->render('courses/course-edit.html.twig', [
            
        ]);
    }

    #[Route('/{course}/update', name: 'courses.update', methods: ['PUT'])]
    public function update()
    {
        // TOdo add functionality
    }

    #[Route('/{course}/delete', name: 'courses.delete', methods: ['DELETE'])]
    public function delete(): Response
    {
        return new Response('');
    }
}
