<?php

namespace App\Entity;

use App\Repository\LecturerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LecturerRepository::class)
 */
class Lecturer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="lecturer", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Education::class, mappedBy="lecturer")
     */
    private $education;

    /**
     * @ORM\Column(type="string", length=50, nullable=true, columnDefinition="ENUM('Lecturer', 'Senior_lecturer', 'Docent', 'Software_engineer', 'Senior_laboratory_assistant')")
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cardImage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $professionalInterests;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $publicationsCount;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $projectsCount;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $conferencesCount;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $diplomaProjectsCount;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity=Group::class, mappedBy="curator", cascade={"persist", "remove"})
     */
    private $associatedGroup;

    /**
     * @ORM\OneToMany(targetEntity=Regalia::class, mappedBy="lecturer")
     */
    private $regalias;

    /**
     * @ORM\OneToOne(targetEntity=TimeTable::class, mappedBy="lecturer", cascade={"persist", "remove"})
     */
    private $timeTable;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $publicationsText;

    public function __construct()
    {
        $this->education = new ArrayCollection();
        $this->regalias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Education[]
     */
    public function getEducation(): Collection
    {
        return $this->education;
    }

    public function addEducation(Education $education): self
    {
        if (!$this->education->contains($education)) {
            $this->education[] = $education;
            $education->setLecturer($this);
        }

        return $this;
    }

    public function removeEducation(Education $education): self
    {
        if ($this->education->removeElement($education)) {
            // set the owning side to null (unless already changed)
            if ($education->getLecturer() === $this) {
                $education->setLecturer(null);
            }
        }

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getCardImage(): ?string
    {
        return $this->cardImage;
    }

    public function setCardImage(?string $cardImage): self
    {
        $this->cardImage = $cardImage;

        return $this;
    }

    public function getProfessionalInterests(): ?string
    {
        return $this->professionalInterests;
    }

    public function setProfessionalInterests(?string $professionalInterests): self
    {
        $this->professionalInterests = $professionalInterests;

        return $this;
    }

    public function getPublicationsCount(): ?int
    {
        return $this->publicationsCount;
    }

    public function setPublicationsCount(?int $publicationsCount): self
    {
        $this->publicationsCount = $publicationsCount;

        return $this;
    }

    public function getProjectsCount(): ?int
    {
        return $this->projectsCount;
    }

    public function setProjectsCount(?int $projectsCount): self
    {
        $this->projectsCount = $projectsCount;

        return $this;
    }

    public function getConferencesCount(): ?int
    {
        return $this->conferencesCount;
    }

    public function setConferencesCount(?int $conferencesCount): self
    {
        $this->conferencesCount = $conferencesCount;

        return $this;
    }

    public function getDiplomaProjectsCount(): ?int
    {
        return $this->diplomaProjectsCount;
    }

    public function setDiplomaProjectsCount(?int $diplomaProjectsCount): self
    {
        $this->diplomaProjectsCount = $diplomaProjectsCount;

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

    public function getAssociatedGroup(): ?Group
    {
        return $this->associatedGroup;
    }

    public function setAssociatedGroup(Group $associatedGroup): self
    {
        // set the owning side of the relation if necessary
        if ($associatedGroup->getCurator() !== $this) {
            $associatedGroup->setCurator($this);
        }

        $this->associatedGroup = $associatedGroup;

        return $this;
    }

    /**
     * @return Collection|Regalia[]
     */
    public function getRegalias(): Collection
    {
        return $this->regalias;
    }

    public function addRegalias(Regalia $regalias): self
    {
        if (!$this->regalias->contains($regalias)) {
            $this->regalias[] = $regalias;
            $regalias->setLecturer($this);
        }

        return $this;
    }

    public function removeRegalias(Regalia $regalias): self
    {
        if ($this->regalias->removeElement($regalias)) {
            // set the owning side to null (unless already changed)
            if ($regalias->getLecturer() === $this) {
                $regalias->setLecturer(null);
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
        if ($timeTable->getLecturer() !== $this) {
            $timeTable->setLecturer($this);
        }

        $this->timeTable = $timeTable;

        return $this;
    }

    public function getPublicationsText(): ?string
    {
        return $this->publicationsText;
    }

    public function setPublicationsText(?string $publicationsText): self
    {
        $this->publicationsText = $publicationsText;

        return $this;
    }
}
