<?php 
namespace App\Service;

use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;

class RoleService {
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function create() {
        $role = new Role();
        $role->setName('admin');

        $this->entityManager->persist($role);
        $this->entityManager->flush();
        
        return $role;
    }
}