<?php

namespace App\Entity;

use App\Repository\TimeTableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TimeTableRepository::class)
 */
class TimeTable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Group::class, inversedBy="timeTable", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $associatedGroup;

    /**
     * @ORM\OneToOne(targetEntity=Day::class, inversedBy="timeTable", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $day;

    /**
     * @ORM\OneToOne(targetEntity=Subject::class, inversedBy="timeTable", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $subject;

    /**
     * @ORM\OneToOne(targetEntity=Lecturer::class, inversedBy="timeTable", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $lecturer;

    /**
     * @ORM\OneToOne(targetEntity=Type::class, inversedBy="timeTable", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity=Audience::class, inversedBy="timeTable", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $audience;

    /**
     * @ORM\Column(type="smallint")
     */
    private $pairNumber;

    /**
     * @ORM\Column(type="time")
     */
    private $pairStart;

    /**
     * @ORM\Column(type="time")
     */
    private $pairEnd;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="timeTable", cascade={"persist", "remove"})
     */
    private $deletionAuthor;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $additionalInfo;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssociatedGroup(): ?Group
    {
        return $this->associatedGroup;
    }

    public function setAssociatedGroup(Group $associatedGroup): self
    {
        $this->associatedGroup = $associatedGroup;

        return $this;
    }

    public function getDay(): ?Day
    {
        return $this->day;
    }

    public function setDay(Day $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getLecturer(): ?Lecturer
    {
        return $this->lecturer;
    }

    public function setLecturer(Lecturer $lecturer): self
    {
        $this->lecturer = $lecturer;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAudience(): ?Audience
    {
        return $this->audience;
    }

    public function setAudience(Audience $audience): self
    {
        $this->audience = $audience;

        return $this;
    }

    public function getPairNumber(): ?int
    {
        return $this->pairNumber;
    }

    public function setPairNumber(int $pairNumber): self
    {
        $this->pairNumber = $pairNumber;

        return $this;
    }

    public function getPairStart(): ?\DateTimeInterface
    {
        return $this->pairStart;
    }

    public function setPairStart(\DateTimeInterface $pairStart): self
    {
        $this->pairStart = $pairStart;

        return $this;
    }

    public function getPairEnd(): ?\DateTimeInterface
    {
        return $this->pairEnd;
    }

    public function setPairEnd(\DateTimeInterface $pairEnd): self
    {
        $this->pairEnd = $pairEnd;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getDeletionAuthor(): ?User
    {
        return $this->deletionAuthor;
    }

    public function setDeletionAuthor(?User $deletionAuthor): self
    {
        $this->deletionAuthor = $deletionAuthor;

        return $this;
    }

    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    public function setAdditionalInfo(?string $additionalInfo): self
    {
        $this->additionalInfo = $additionalInfo;

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

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }
}
