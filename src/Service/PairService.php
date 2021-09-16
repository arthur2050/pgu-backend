<?php 
namespace App\Service;

use App\Entity\Pair;
use Doctrine\ORM\EntityManagerInterface;

class PairService {
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function create() {
        $pair = new Pair();
        $pair->setStart('8:30');
        $pair->setEnd('9:50');
        $pair->setNumber(1);
        
        $entityManager = $this->entityManager;
        $entityManager->persist($pair);
        $entityManager->flush();
        
        return $pair;
    }
}