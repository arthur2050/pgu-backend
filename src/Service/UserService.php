<?php 
namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\RoleService;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\GroupService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserService {
    public function __construct(
                                EntityManagerInterface $entityManager, 
                                RoleService $role,
                                GroupService $group,
                                UserRepository $userRepo) {
        $this->roleService = $role;
        $this->entityManager = $entityManager;
        $this->groupService = $group;
        $this->userRepo = $userRepo;
    }

    public function findAll() {
        return $this->userRepo->findAll();
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
        $entityManager->persist($user);
        $entityManager->flush();
        
        return $user;
    }
}