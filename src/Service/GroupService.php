<?php 
namespace App\Service;

use App\Entity\Group;
use Doctrine\ORM\EntityManagerInterface;

class GroupService {
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function create() {
        $group = new Group();
        $group->setName('320PI');
        $group->setNumber(320);
        $group->setFullName('320PITEST');
        $group->setYearCreated(2019);

        $this->entityManager->persist($group);
        $this->entityManager->flush();
        
        return $group;
    }
}