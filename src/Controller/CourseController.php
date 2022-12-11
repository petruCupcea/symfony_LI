<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Faculty;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CourseController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('', name: 'courses.index')]
    public function index(): Response
    {
        $courses = $this->doctrine->getRepository(Course::class)->findAll();

        return $this->render('courses/course-list.html.twig', [
            'courses' => $courses
        ]);
    }

    // Look in routes.yaml
    public function show(int $course): Response
    {
        $courseObject = $this->doctrine->getRepository(Course::class)->find($course);

        return $this->render('courses/course-show.html.twig', [
            'course' => $courseObject
        ]);
    }

    #[Route('/create', name: 'courses.create')]
    public function create(): Response
    {
        $faculties = $this->doctrine->getRepository(Faculty::class)->findAll();

        return $this->render('courses/course-add.html.twig', [
            'faculties' => $faculties
        ]);
    }

    #[Route('/store', name: 'courses.store', methods: ['POST'])]
    public function store(Request $request)
    {
        $data = $request->request->all();

        $faculty = $this->doctrine->getRepository(Faculty::class)->find($data['faculty_id']);
        $course = new Course();
        $course
            ->setFaculty($faculty)
            ->setName($data['name'])
            ->setOptional($data['optional'] ?? 0)
            ->setProfessor($data['professor']);

        /** @var CourseRepository $courseRepository */
        $courseRepository = $this->doctrine->getRepository(Course::class);
        $courseRepository->save($course, true);

        return $this->redirectToRoute('courses.index');
    }

    #[Route('/{course}/edit', name: 'courses.edit')]
    public function edit(int $course): Response
    {
        /** @var CourseRepository $courseRepository */
        $courseRepository = $this->doctrine->getRepository(Course::class);
        $courseObject = $courseRepository->findById($course);
        $faculties = $this->doctrine->getRepository(Faculty::class)->findAll();

        return $this->render('courses/course-edit.html.twig', [
            'course' => $courseObject,
            'faculties' => $faculties,
        ]);
    }

    #[Route('/{course}/update', name: 'courses.update', methods: ['POST'])]
    public function update(Request $request, int $course)
    {
        /** @var CourseRepository $courseRepository */
        $courseRepository = $this->doctrine->getRepository(Course::class);
        $courseObject = $courseRepository->find($course);
        $data = $request->request->all();

        $faculty = $this->doctrine->getRepository(Faculty::class)->find($data['faculty_id']);

        $courseObject
            ->setFaculty($faculty)
            ->setName($data['name'])
            ->setOptional($data['optional'] ?? 0)
            ->setProfessor($data['professor']);

        $courseRepository->save($courseObject, true);

        return $this->redirectToRoute('courses.index');
    }

    #[Route('/{course}/delete', name: 'courses.delete', methods: ['POST'])]
    public function delete(int $course): Response
    {
        /** @var CourseRepository $courseRepository */
        $courseRepository = $this->doctrine->getRepository(Course::class);
        $courseObject = $courseRepository->find($course);

        $courseRepository->remove($courseObject, true);

        return $this->redirectToRoute('courses.index');
    }
}