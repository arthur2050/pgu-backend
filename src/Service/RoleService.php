<?php 
namespace App\Service;

use App\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class RoleService {
    public function __construct(string $roleData,EntityManagerInterface $entityManager) {
        $this->roleName = $roleData;
        $this->entityManager = $entityManager;
    }
    public function create() {
        $role = new Role();
        $role->setName('admin');
        $entityManager = $this->entityManager;
        
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($role);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return $role;
    }
}