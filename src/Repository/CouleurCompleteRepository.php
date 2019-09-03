<?php

namespace App\Repository;

use App\Entity\CouleurComplete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CouleurComplete|null find($id, $lockMode = null, $lockVersion = null)
 * @method CouleurComplete|null findOneBy(array $criteria, array $orderBy = null)
 * @method CouleurComplete[]    findAll()
 * @method CouleurComplete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CouleurCompleteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CouleurComplete::class);
    }

    // /**
    //  * @return CouleurComplete[] Returns an array of CouleurComplete objects
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
    public function findOneBySomeField($value): ?CouleurComplete
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
