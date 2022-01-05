<?php

namespace App\Repository;

use App\Entity\TicketType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TicketType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketType[]    findAll()
 * @method TicketType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TicketType::class);
    }

    // /**
    //  * @return TicketType[] Returns an array of TicketType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TicketType
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
