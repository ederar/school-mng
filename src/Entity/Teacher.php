<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeacherRepository")
 */
class Teacher implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="teachers")
     */
    private $matiere;

    /**
     * @ORM\ManyToMany(targetEntity=ClassRoom::class, inversedBy="teachers")
     */
    private $classRoom;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="teachers")
     */
    private $role;

    public function __construct()
    {
        $this->classRoom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    /**
     * @return Collection|ClassRoom[]
     */
    public function getClassRoom(): Collection
    {
        return $this->classRoom;
    }

    public function addClassRoom(ClassRoom $classRoom): self
    {
        if (!$this->classRoom->contains($classRoom)) {
            $this->classRoom[] = $classRoom;
        }

        return $this;
    }

    public function removeClassRoom(ClassRoom $classRoom): self
    {
        $this->classRoom->removeElement($classRoom);

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getSalt()
    {
        
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        
    }

    public function getRoles()
    {
        
        return [$this->role->getTitle()];
    }
}
