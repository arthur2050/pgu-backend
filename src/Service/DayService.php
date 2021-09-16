<?php 
namespace App\Service;

use App\Entity\Day;
use Doctrine\ORM\EntityManagerInterface;

class DayService {
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function create() {
        $day = new Day();
        $day->setName('test');
        
        $entityManager = $this->entityManager;
        $entityManager->persist($day);
        $entityManager->flush();
        
        return $day;
    }
}