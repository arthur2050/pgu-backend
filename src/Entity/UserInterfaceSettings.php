<?php

namespace App\Entity;

use App\Repository\UserInterfaceSettingsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserInterfaceSettingsRepository::class)
 */
class UserInterfaceSettings
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
    private $colorFilters;

    /**
     * @ORM\Column(type="smallint")
     */
    private $colorBackground;

    /**
     * @ORM\Column(type="boolean")
     */
    private $darkMode;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sidebarMini;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sidebarImage;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $selectedImage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColorFilters(): ?int
    {
        return $this->colorFilters;
    }

    public function setColorFilters(int $colorFilters): self
    {
        $this->colorFilters = $colorFilters;

        return $this;
    }

    public function getColorBackground(): ?int
    {
        return $this->colorBackground;
    }

    public function setColorBackground(int $colorBackground): self
    {
        $this->colorBackground = $colorBackground;

        return $this;
    }

    public function getDarkMode(): ?bool
    {
        return $this->darkMode;
    }

    public function setDarkMode(bool $darkMode): self
    {
        $this->darkMode = $darkMode;

        return $this;
    }

    public function getSidebarMini(): ?bool
    {
        return $this->sidebarMini;
    }

    public function setSidebarMini(bool $sidebarMini): self
    {
        $this->sidebarMini = $sidebarMini;

        return $this;
    }

    public function getSidebarImage(): ?bool
    {
        return $this->sidebarImage;
    }

    public function setSidebarImage(bool $sidebarImage): self
    {
        $this->sidebarImage = $sidebarImage;

        return $this;
    }

    public function getSelectedImage(): ?int
    {
        return $this->selectedImage;
    }

    public function setSelectedImage(?int $selectedImage): self
    {
        $this->selectedImage = $selectedImage;

        return $this;
    }
}
