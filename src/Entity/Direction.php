<?php

namespace App\Entity;

use App\Repository\DirectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DirectionRepository::class)
 */
class Direction
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
    private $code;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $videoLink;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Profile::class, mappedBy="direction")
     */
    private $profiles;

    /**
     * @ORM\OneToMany(targetEntity=PaymentForm::class, mappedBy="direction")
     */
    private $paymentForms;

    /**
     * @ORM\OneToMany(targetEntity=PreparationExam::class, mappedBy="direction")
     */
    private $preparationExams;

    /**
     * @ORM\OneToMany(targetEntity=Specialty::class, mappedBy="direction")
     */
    private $specialties;

    /**
     * @ORM\OneToMany(targetEntity=StudyStage::class, mappedBy="direction")
     */
    private $studyStages;

    /**
     * @ORM\OneToOne(targetEntity=Group::class, mappedBy="direction", cascade={"persist", "remove"})
     */
    private $associatedStudentsGroup;

    public function __construct()
    {
        $this->profiles = new ArrayCollection();
        $this->paymentForms = new ArrayCollection();
        $this->preparationExams = new ArrayCollection();
        $this->specialties = new ArrayCollection();
        $this->studyStages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->videoLink;
    }

    public function setVideoLink(?string $videoLink): self
    {
        $this->videoLink = $videoLink;

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
     * @return Collection|Profile[]
     */
    public function getProfiles(): Collection
    {
        return $this->profiles;
    }

    public function addProfile(Profile $profile): self
    {
        if (!$this->profiles->contains($profile)) {
            $this->profiles[] = $profile;
            $profile->setDirection($this);
        }

        return $this;
    }

    public function removeProfile(Profile $profile): self
    {
        if ($this->profiles->removeElement($profile)) {
            // set the owning side to null (unless already changed)
            if ($profile->getDirection() === $this) {
                $profile->setDirection(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PaymentForm[]
     */
    public function getPaymentForms(): Collection
    {
        return $this->paymentForms;
    }

    public function addPaymentForm(PaymentForm $paymentForm): self
    {
        if (!$this->paymentForms->contains($paymentForm)) {
            $this->paymentForms[] = $paymentForm;
            $paymentForm->setDirection($this);
        }

        return $this;
    }

    public function removePaymentForm(PaymentForm $paymentForm): self
    {
        if ($this->paymentForms->removeElement($paymentForm)) {
            // set the owning side to null (unless already changed)
            if ($paymentForm->getDirection() === $this) {
                $paymentForm->setDirection(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PreparationExam[]
     */
    public function getPreparationExams(): Collection
    {
        return $this->preparationExams;
    }

    public function addPreparationExam(PreparationExam $preparationExam): self
    {
        if (!$this->preparationExams->contains($preparationExam)) {
            $this->preparationExams[] = $preparationExam;
            $preparationExam->setDirection($this);
        }

        return $this;
    }

    public function removePreparationExam(PreparationExam $preparationExam): self
    {
        if ($this->preparationExams->removeElement($preparationExam)) {
            // set the owning side to null (unless already changed)
            if ($preparationExam->getDirection() === $this) {
                $preparationExam->setDirection(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Specialty[]
     */
    public function getSpecialties(): Collection
    {
        return $this->specialties;
    }

    public function addSpecialty(Specialty $specialty): self
    {
        if (!$this->specialties->contains($specialty)) {
            $this->specialties[] = $specialty;
            $specialty->setDirection($this);
        }

        return $this;
    }

    public function removeSpecialty(Specialty $specialty): self
    {
        if ($this->specialties->removeElement($specialty)) {
            // set the owning side to null (unless already changed)
            if ($specialty->getDirection() === $this) {
                $specialty->setDirection(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|StudyStage[]
     */
    public function getStudyStages(): Collection
    {
        return $this->studyStages;
    }

    public function addStudyStage(StudyStage $studyStage): self
    {
        if (!$this->studyStages->contains($studyStage)) {
            $this->studyStages[] = $studyStage;
            $studyStage->setDirection($this);
        }

        return $this;
    }

    public function removeStudyStage(StudyStage $studyStage): self
    {
        if ($this->studyStages->removeElement($studyStage)) {
            // set the owning side to null (unless already changed)
            if ($studyStage->getDirection() === $this) {
                $studyStage->setDirection(null);
            }
        }

        return $this;
    }

    public function getAssociatedStudentsGroup(): ?Group
    {
        return $this->associatedStudentsGroup;
    }

    public function setAssociatedStudentsGroup(Group $associatedStudentsGroup): self
    {
        // set the owning side of the relation if necessary
        if ($associatedStudentsGroup->getDirection() !== $this) {
            $associatedStudentsGroup->setDirection($this);
        }

        $this->associatedStudentsGroup = $associatedStudentsGroup;

        return $this;
    }

}
