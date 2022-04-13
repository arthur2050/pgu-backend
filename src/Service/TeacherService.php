<?php 
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class TeacherService {
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function create() {
        $teacher = new Teacher();
        $teacher->setName('test');
        // TODO $teacher->setUser();
        $teacher->setSurname('test');
        $teacher->setPatronymic('test');
        $teacher->setPosition('test');
        $teacher->setSubjects([]);
        $teacher->setAvatarPath('test');
        
        $entityManager = $this->entityManager;
        $entityManager->persist($teacher);
        $entityManager->flush();
        
        return $teacher;
    }
}