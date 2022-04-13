<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubjectRepository::class)z
 */
class Subject
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
     * @ORM\OneToOne(targetEntity=TimeTable::class, mappedBy="subject", cascade={"persist", "remove"})
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

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTimeTable(): ?TimeTable
    {
        return $this->timeTable;
    }

    public function setTimeTable(TimeTable $timeTable): self
    {
        // set the owning side of the relation if necessary
        if ($timeTable->getSubject() !== $this) {
            $timeTable->setSubject($this);
        }

        $this->timeTable = $timeTable;

        return $this;
    }
}
