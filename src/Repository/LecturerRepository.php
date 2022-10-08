<?php

namespace App\Repository;

use App\Entity\Lecturer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lecturer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lecturer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lecturer[]    findAll()
 * @method Lecturer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LecturerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lecturer::class);
    }

}
