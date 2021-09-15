<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScheduleRepository::class)
 */
class Schedule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Group::class, inversedBy="schedule", cascade={"persist", "remove"})
     */
    private $group;

    /**
     * @ORM\Column(type="integer")
     */
    private $pair_number;

    /**
     * @ORM\Column(type="integer")
     */
    private $day_number;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $even;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $odd;

    /**
     * @ORM\OneToOne(targetEntity=Teacher::class, inversedBy="schedule", cascade={"persist", "remove"})
     */
    private $even_teacher;

    /**
     * @ORM\OneToOne(targetEntity=Teacher::class, inversedBy="schedule", cascade={"persist", "remove"})
     */
    private $odd_teacher;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $day_name;

    /**
     * @ORM\OneToOne(targetEntity=Subject::class, inversedBy="schedule", cascade={"persist", "remove"})
     */
    private $subject;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?int 
    {
        return $this->subject;
    }
    public function setSubject(int $subject): self {
        $this->subject = $subject;
        return $this;
    }

    public function getGroupNumber(): ?int
    {
        return $this->group_number;
    }

    public function setGroupNumber(int $group_number): self
    {
        $this->group_number = $group_number;

        return $this;
    }

    public function getGroup(): ?string
    {
        return $this->group;
    }

    public function setGroup(string $group): self
    {
        $this->group_name = $group;

        return $this;
    }

    public function getPairNumber(): ?int
    {
        return $this->pair_number;
    }

    public function setPairNumber(int $pair_number): self
    {
        $this->pair_number = $pair_number;

        return $this;
    }

    public function getDayNumber(): ?int
    {
        return $this->day_number;
    }

    public function setDayNumber(int $day_number): self
    {
        $this->day_number = $day_number;

        return $this;
    }

    public function getEven(): ?bool
    {
        return $this->even;
    }

    public function setEven(?bool $even): self
    {
        $this->even = $even;

        return $this;
    }

    public function getOdd(): ?bool
    {
        return $this->odd;
    }

    public function setOdd(?bool $odd): self
    {
        $this->odd = $odd;

        return $this;
    }

    public function getEvenTeacher(): ?Teacher
    {
        return $this->even_teacher;
    }

    public function setEvenTeacher(?Teacher $even_teacher): self
    {
        $this->even_teacher = $even_teacher;

        return $this;
    }

    public function getOddTeacher(): ?Teacher
    {
        return $this->odd_teacher;
    }

    public function setOddTeacher(?Teacher $odd_teacher): self
    {
        $this->odd_teacher = $odd_teacher;

        return $this;
    }

    public function getDayName(): ?string
    {
        return $this->day_name;
    }

    public function setDayName(string $day_name): self
    {
        $this->day_name = $day_name;

        return $this;
    }
}
