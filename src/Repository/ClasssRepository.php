<?php

namespace App\Repository;

use App\Entity\Classs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Classs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classs[]    findAll()
 * @method Classs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasssRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classs::class);
    }

    // /**
    //  * @return Classs[] Returns an array of Classs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Classs
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
