<?php 
namespace App\Service;

use App\Entity\Audience;
use Doctrine\ORM\EntityManagerInterface;

class AudienceService {
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function create() {
        $audience = new Audience();
        $audience->setName('test');
        $audience->setCapacity(30);
        
        $entityManager = $this->entityManager;
        $entityManager->persist($audience);
        $entityManager->flush();
        
        return $audience;
    }
}