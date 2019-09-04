<?php

namespace App\Repository;

use App\Entity\ExRates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ExRates|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExRates|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExRates[]    findAll()
 * @method ExRates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExRatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExRates::class);
    }

    // /**
    //  * @return ExRates[] Returns an array of ExRates objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExRates
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
