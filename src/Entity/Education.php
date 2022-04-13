<?php

namespace App\Entity;

use App\Repository\EducationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EducationRepository::class)
 */
class Education
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, columnDefinition="ENUM('Higher', 'Secondary', 'Secondary_special')")
     */
    private $level;

    /**
     * @ORM\Column(type="text")
     */
    private $place;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $proofDocumentLink;

    /**
     * @ORM\ManyToOne(targetEntity=Lecturer::class, inversedBy="education")
     */
    private $lecturer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getProofDocumentLink(): ?string
    {
        return $this->proofDocumentLink;
    }

    public function setProofDocumentLink(string $proofDocumentLink): self
    {
        $this->proofDocumentLink = $proofDocumentLink;

        return $this;
    }

    public function getLecturer(): ?Lecturer
    {
        return $this->lecturer;
    }

    public function setLecturer(?Lecturer $lecturer): self
    {
        $this->lecturer = $lecturer;

        return $this;
    }
}
