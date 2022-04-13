<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=Lecturer::class, inversedBy="associatedGroup", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $curator;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="associatedHeadmanGroup", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $headman;

    /**
     * @ORM\OneToOne(targetEntity=Direction::class, inversedBy="associatedStudentsGroup", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $direction;

    /**
     * @ORM\OneToOne(targetEntity=StudyVariant::class, inversedBy="associatedStudentsGroup", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $studyVariant;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="associatedGroup")
     */
    private $students;

    /**
     * @ORM\OneToOne(targetEntity=TimeTable::class, mappedBy="associatedGroup", cascade={"persist", "remove"})
     */
    private $timeTable;

    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCurator(): ?Lecturer
    {
        return $this->curator;
    }

    public function setCurator(Lecturer $curator): self
    {
        $this->curator = $curator;

        return $this;
    }

    public function getHeadman(): ?User
    {
        return $this->headman;
    }

    public function setHeadman(User $headman): self
    {
        $this->headman = $headman;

        return $this;
    }

    public function getDirection(): ?Direction
    {
        return $this->direction;
    }

    public function setDirection(Direction $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    public function getStudyVariant(): ?StudyVariant
    {
        return $this->studyVariant;
    }

    public function setStudyVariant(StudyVariant $studyVariant): self
    {
        $this->studyVariant = $studyVariant;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(User $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setAssociatedGroup($this);
        }

        return $this;
    }

    public function removeStudent(User $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getAssociatedGroup() === $this) {
                $student->setAssociatedGroup(null);
            }
        }

        return $this;
    }

    public function getTimeTable(): ?TimeTable
    {
        return $this->timeTable;
    }

    public function setTimeTable(TimeTable $timeTable): self
    {
        // set the owning side of the relation if necessary
        if ($timeTable->getAssociatedGroup() !== $this) {
            $timeTable->setAssociatedGroup($this);
        }

        $this->timeTable = $timeTable;

        return $this;
    }
}
