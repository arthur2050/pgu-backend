<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar_path;

    /**
     * @ORM\OneToOne(targetEntity=Lecturer::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $lecturer;

    /**
     * @ORM\OneToOne(targetEntity=Group::class, mappedBy="headman", cascade={"persist", "remove"})
     */
    private $associatedHeadmanGroup;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="students")
     */
    private $associatedGroup;

    /**
     * @ORM\OneToOne(targetEntity=TimeTable::class, mappedBy="deletionAuthor", cascade={"persist", "remove"})
     */
    private $timeTable;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $lang;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $patronymic;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }
    
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getAvatarPath(): ?string
    {
        return $this->avatar_path;
    }

    public function setAvatarPath(?string $avatar_path): self
    {
        $this->avatar_path = $avatar_path;

        return $this;
    }

    public function getLecturer(): ?Lecturer
    {
        return $this->lecturer;
    }

    public function setLecturer(Lecturer $lecturer): self
    {
        // set the owning side of the relation if necessary
        if ($lecturer->getUser() !== $this) {
            $lecturer->setUser($this);
        }

        $this->lecturer = $lecturer;

        return $this;
    }

    public function getAssociatedHeadmanGroup(): ?Group
    {
        return $this->associatedHeadmanGroup;
    }

    public function setAssociatedHeadmanGroup(Group $associatedHeadmanGroup): self
    {
        // set the owning side of the relation if necessary
        if ($associatedHeadmanGroup->getHeadman() !== $this) {
            $associatedHeadmanGroup->setHeadman($this);
        }

        $this->associatedHeadmanGroup = $associatedHeadmanGroup;

        return $this;
    }

    public function getAssociatedGroup(): ?Group
    {
        return $this->associatedGroup;
    }

    public function setAssociatedGroup(?Group $associatedGroup): self
    {
        $this->associatedGroup = $associatedGroup;

        return $this;
    }

    public function getTimeTable(): ?TimeTable
    {
        return $this->timeTable;
    }

    public function setTimeTable(?TimeTable $timeTable): self
    {
        // unset the owning side of the relation if necessary
        if ($timeTable === null && $this->timeTable !== null) {
            $this->timeTable->setDeletionAuthor(null);
        }

        // set the owning side of the relation if necessary
        if ($timeTable !== null && $timeTable->getDeletionAuthor() !== $this) {
            $timeTable->setDeletionAuthor($this);
        }

        $this->timeTable = $timeTable;

        return $this;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(?string $patronymic): self
    {
        $this->patronymic = $patronymic;

        return $this;
    }

}
