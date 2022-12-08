<?php

namespace App\Entity;

use App\Repository\StudyVariantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudyVariantRepository::class)
 */
class StudyVariant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $years;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $months;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=50, columnDefinition="ENUM('full_time', 'part_time')")
     */
    private $timeForm;

    /**
     * @ORM\OneToOne(targetEntity=Group::class, mappedBy="studyVariant", cascade={"persist", "remove"})
     */
    private $associatedStudentsGroup;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYears(): ?int
    {
        return $this->years;
    }

    public function setYears(int $years): self
    {
        $this->years = $years;

        return $this;
    }

    public function getMonths(): ?int
    {
        return $this->months;
    }

    public function setMonths(?int $months): self
    {
        $this->months = $months;

        return $this;
    }

    public function getTimeFormId(): ?TimeForm
    {
        return $this->timeFormId;
    }

    public function setTimeFormId(TimeForm $timeFormId): self
    {
        $this->timeFormId = $timeFormId;

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

    public function getDirectionStudyVariant(): ?DirectionStudyVariant
    {
        return $this->directionStudyVariant;
    }

    public function setDirectionStudyVariant(DirectionStudyVariant $directionStudyVariant): self
    {
        // set the owning side of the relation if necessary
        if ($directionStudyVariant->getStudyVariantId() !== $this) {
            $directionStudyVariant->setStudyVariantId($this);
        }

        $this->directionStudyVariant = $directionStudyVariant;

        return $this;
    }

    public function getTimeForm(): ?string
    {
        return $this->timeForm;
    }

    public function setTimeForm(string $timeForm): self
    {
        $this->timeForm = $timeForm;

        return $this;
    }

    public function getAssociatedStudentsGroup(): ?Group
    {
        return $this->associatedStudentsGroup;
    }

    public function setAssociatedStudentsGroup(Group $associatedStudentsGroup): self
    {
        // set the owning side of the relation if necessary
        if ($associatedStudentsGroup->getStudyVariant() !== $this) {
            $associatedStudentsGroup->setStudyVariant($this);
        }

        $this->associatedStudentsGroup = $associatedStudentsGroup;

        return $this;
    }
}
