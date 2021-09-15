<?php 
namespace App\Service;

use App\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class GroupService {
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function create() {
        $group = new Group();
        $group->setName('320PI');
        $group->setNumber(320);
        $group->setFullName('320PITEST');
        $group->setYearCreated(2019);
        $entityManager = $this->entityManager;
        
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($group);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return $group;
    }
}