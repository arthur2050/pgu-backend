<?php 
namespace App\Service;

use App\Entity\User;
use App\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\RoleService;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\GroupService;

class UserService {
    public function __construct($userData="", 
                                EntityManagerInterface $entityManager, 
                                RoleService $role,
                                GroupService $group) {
        $this->userData = $userData;
        $this->roleService = $role;
        $this->entityManager = $entityManager;
        $this->groupService = $group;
    }
    public function create() {
        $user = new User();
        $user->setName('vanya');
        $user->setPhone('373228');
        $user->setEmail('testmail@ru');
        $user->setSurname('vaaa');
        $user->setPassword('password');
        $user->setAvatarPath('test');
        $user->setGroup($this->groupService->create());
        $user->setRole($this->roleService->create("admin"));
        $entityManager = $this->entityManager;
        
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return $user;
    }
}