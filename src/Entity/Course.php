<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name = '';

    #[ORM\Column]
    private bool $optional = false;

    #[ManyToOne(targetEntity: Faculty::class)]
    #[JoinColumn(name: 'faculty_id', referencedColumnName: 'id')]
    private Faculty $faculty;

    #[ORM\Column(length: 255)]
    private string $professor = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isOptional(): bool
    {
        return $this->optional;
    }

    public function setOptional(bool $optional): self
    {
        $this->optional = $optional;

        return $this;
    }

    public function getFaculty(): Faculty
    {
        return $this->faculty;
    }

    public function setFaculty(Faculty $faculty): self
    {
        $this->faculty = $faculty;

        return $this;
    }

    public function getProfessor(): string
    {
        return $this->professor;
    }

    public function setProfessor(string $professor): self
    {
        $this->professor = $professor;

        return $this;
    }
}