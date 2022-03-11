<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScheduleRepository::class)
 * @ORM\Table(name="schedule")
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
     * @ORM\OneToOne(targetEntity=Pair::class, inversedBy="schedule", cascade={"persist", "remove"})
     */
    private $pair;

    /**
     * @ORM\OneToOne(targetEntity=Day::class, inversedBy="schedule", cascade={"persist", "remove"})
     */
    private $day;

    /**
     * @ORM\OneToOne(targetEntity=Audience::class, inversedBy="schedule", cascade={"persist", "remove"})
     */
    private $audience;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isEven;


    /**
     * @ORM\OneToOne(targetEntity=Teacher::class, inversedBy="schedule", cascade={"persist", "remove"})
     */
    private $even_teacher;

    /**
     * @ORM\OneToOne(targetEntity=Subject::class, inversedBy="schedule", cascade={"persist", "remove"})
     */
    private $even_subject;

    /**
     * @ORM\OneToOne(targetEntity=Teacher::class, inversedBy="schedule", cascade={"persist", "remove"})
     */
    private $odd_teacher;

    /**
     * @ORM\OneToOne(targetEntity=Subject::class, inversedBy="schedule", cascade={"persist", "remove"})
     */
    private $odd_subject;



    public function getId(): ?int
    {
        return $this->id;
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

    public function getGroup(): ?Group
    {
        return $this->group;
    }

    public function setGroup(Group $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function getPair(): ?Pair
    {
        return $this->pair;
    }

    public function setPair(Pair $pair): self
    {
        $this->pair = $pair;

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

    public function getIsEven(): ?bool
    {
        return $this->isEven;
    }

    public function setIsEven(?bool $even): self
    {
        $this->isEven = $even;

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

    public function getEvenSubject(): ?Subject {
        return $this->even_subject;
    }
    public function setEvenSubject(Subject $even_subject): self {
        $this->even_subject = $even_subject;
        return $this;
    }
    
    public function getOddSubject(): ?Subject {
        return $this->odd_subject;
    }
    public function setOddSubject(Subject $odd_subject): self {
        $this->odd_subject = $odd_subject;
        return $this;
    }

    public function getAudience(): ?Audience {
        return $this->audience;
    }
    public function setAudience(Audience $audience): self {
        $this->audience = $audience;
        return $this;
    }
}
