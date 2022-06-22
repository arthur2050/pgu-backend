<?php

namespace App\Repository;

use App\Entity\UserInterfaceSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserInterfaceSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserInterfaceSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserInterfaceSettings[]    findAll()
 * @method UserInterfaceSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserInterfaceSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserInterfaceSettings::class);
    }

    // /**
    //  * @return UserInterfaceSettings[] Returns an array of UserInterfaceSettings objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserInterfaceSettings
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
