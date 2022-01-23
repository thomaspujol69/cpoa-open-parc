<?php

namespace App\Repository;

use App\Entity\BallBoysTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BallBoysTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method BallBoysTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method BallBoysTeam[]    findAll()
 * @method BallBoysTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BallBoysTeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BallBoysTeam::class);
    }

    // /**
    //  * @return BallBoysTeam[] Returns an array of BallBoysTeam objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BallBoysTeam
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
