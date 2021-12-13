<?php

namespace App\Repository;

use App\Entity\Arbitrator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Arbitrator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arbitrator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arbitrator[]    findAll()
 * @method Arbitrator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArbitratorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Arbitrator::class);
    }

    // /**
    //  * @return Arbitrator[] Returns an array of Arbitrator objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Arbitrator
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
