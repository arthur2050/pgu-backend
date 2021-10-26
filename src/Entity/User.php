<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Role;
use App\Entity\Group;
use JsonSerializable;

/**
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Role")
     * @ORM\JoinColumn(nullable=false,name="role_id",referencedColumnName="id")
     */
    private $role;

    /**
     * @ORM\OneToOne(targetEntity=Group::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, name="`group`")
     */
    private $group;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /** 
     * @ORM\Column(type="string", length = 255)
    */
    private $email;

    /** 
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar_path;

    public function getGroup(): ?Group {
        return $this->group;
    }

    public function setGroup(Group $group): self {
        $this->group = $group;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(Role $role_id): self
    {
        $this->role = $role_id;

        return $this;
    }

    public function __toString() {
        return json_encode([
            'phone' => $this->getPhone(),
            'name' => $this->name,
            'id' => $this->id,
            'role' => $this->getRole()
        ]);
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

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword($password): self {
        $this->password = $password;
        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

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

    public function getAvatarPath(): ?string
    {
        return $this->avatar_path;
    }

    public function setAvatarPath(?string $avatar_path): self
    {
        $this->avatar_path = $avatar_path;

        return $this;
    }
}
