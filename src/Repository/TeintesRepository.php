<?php

namespace App\Repository;

use App\Entity\Teintes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Teintes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Teintes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Teintes[]    findAll()
 * @method Teintes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeintesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Teintes::class);
    }

    // /**
    //  * @return Teintes[] Returns an array of Teintes objects
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
    public function findOneBySomeField($value): ?Teintes
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
