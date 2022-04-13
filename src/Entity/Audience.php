<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AudienceRepository::class)
 * @ORM\Table(name="`audience`")
 */
class Audience
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
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacity;

    /**
     * @ORM\OneToOne(targetEntity=TimeTable::class, mappedBy="audience", cascade={"persist", "remove"})
     */
    private $timeTable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getTimeTable(): ?TimeTable
    {
        return $this->timeTable;
    }

    public function setTimeTable(TimeTable $timeTable): self
    {
        // set the owning side of the relation if necessary
        if ($timeTable->getAudience() !== $this) {
            $timeTable->setAudience($this);
        }

        $this->timeTable = $timeTable;

        return $this;
    }
}
