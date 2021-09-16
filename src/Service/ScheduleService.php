<?php 
namespace App\Service;

use App\Entity\Schedule;

use Doctrine\ORM\EntityManagerInterface;

class ScheduleService {
    public function __construct(GroupService $group,
                                EntityManagerInterface $entityManager,
                                DayService $day,
                                PairService $pair,
                                SubjectService $subject,
                                AudienceService $audience) {
        $this->entityManager = $entityManager;
        $this->groupService = $group;
        $this->subjectService = $subject;
        $this->audienceService = $audience;
        $this->pairService = $pair;
        $this->dayService = $day;
    }
    public function create() {
        $schedule = new Schedule();
        $schedule->setGroup($this->groupService->create());
        $schedule->setEvenTeacher(null);
        $schedule->setOddTeacher(null);
        $schedule->setOddSubject($this->subjectService->create());
        $schedule->setEvenSubject($this->subjectService->create());
        $schedule->setPair($this->pairService->create());
        $schedule->setDay($this->dayService->create());
        $schedule->setAudience($this->audienceService->create());
        $schedule->setIsEven(true);
        
        $entityManager = $this->entityManager;
        $entityManager->persist($schedule);
        $entityManager->flush();
        
        return $schedule;
    }
}