<?php

namespace App\Entity;

use App\Repository\MarkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=MarkRepository::class)
 */
class Mark
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="marks")
     */
    private $student;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $examOne;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $examTwo;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="marks")
     * 
     */
    private $matiere;

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getExamOne(): ?string
    {
        return $this->examOne;
    }

    public function setExamOne(?string $examOne): self
    {
        $this->examOne = $examOne;

        return $this;
    }

    public function getExamTwo(): ?string
    {
        return $this->examTwo;
    }

    public function setExamTwo(?string $examTwo): self
    {
        $this->examTwo = $examTwo;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }


}
