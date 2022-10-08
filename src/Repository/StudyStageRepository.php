<?php

namespace App\Repository;

use App\Entity\StudyStage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StudyStage|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudyStage|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudyStage[]    findAll()
 * @method StudyStage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudyStageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudyStage::class);
    }

}
