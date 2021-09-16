<?php 
namespace App\Service;

use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;

class RoleService {
    public function __construct(string $roleData="",EntityManagerInterface $entityManager) {
        $this->roleName = $roleData;
        $this->entityManager = $entityManager;
    }
    public function create() {
        $role = new Role();
        $role->setName('admin');
        
        $entityManager = $this->entityManager;
        $entityManager->persist($role);
        $entityManager->flush();
        
        return $role;
    }
}