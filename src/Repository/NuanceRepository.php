<?php

namespace App\Repository;

use App\Entity\Nuance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Nuance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nuance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nuance[]    findAll()
 * @method Nuance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NuanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nuance::class);
    }

    // /**
    //  * @return Nuances[] Returns an array of Nuances objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nuances
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
