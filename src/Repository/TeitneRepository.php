<?php

namespace App\Repository;

use App\Entity\Teitne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Teitne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Teitne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Teitne[]    findAll()
 * @method Teitne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeitneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Teitne::class);
    }

    // /**
    //  * @return Teitne[] Returns an array of Teitne objects
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
    public function findOneBySomeField($value): ?Teitne
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
