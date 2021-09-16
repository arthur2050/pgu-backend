<?php 
namespace App\Service;

use App\Entity\Subject;
use Doctrine\ORM\EntityManagerInterface;

class SubjectService {
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function create() {
        $subject = new Subject();
        $subject->setName('test');
        
        $entityManager = $this->entityManager;
        $entityManager->persist($subject);
        $entityManager->flush();
        
        return $subject;
    }
}