<?php

namespace App\Repository;

use App\Entity\Day;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Day|null find($id, $lockMode = null, $lockVersion = null)
 * @method Day|null findOneBy(array $criteria, array $orderBy = null)
 * @method Day[]    findAll()
 * @method Day[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Day::class);
    }

    /**
     * @return Day[] Returns an array of Day objects
     */
    public function getAll()
    {
        return $this->createQueryBuilder('d')
            ->orderBy('d.date', 'ASC')
            ->setMaxResults(7)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Day[] Returns an array of Day objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    /**
     * @return Day Returns a Day
     */
    public function findOneByDate($value): ?Day
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.date = :date')
            ->setParameter('date', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }    
}
