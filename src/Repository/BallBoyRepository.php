<?php

namespace App\Repository;

use App\Entity\BallBoy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BallBoy|null find($id, $lockMode = null, $lockVersion = null)
 * @method BallBoy|null findOneBy(array $criteria, array $orderBy = null)
 * @method BallBoy[]    findAll()
 * @method BallBoy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BallBoyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BallBoy::class);
    }

    // /**
    //  * @return BallBoy[] Returns an array of BallBoy objects
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
    public function findOneBySomeField($value): ?BallBoy
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
