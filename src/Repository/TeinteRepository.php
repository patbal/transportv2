<?php

namespace App\Repository;

use App\Entity\Teinte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Teinte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Teinte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Teinte[]    findAll()
 * @method Teinte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeinteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Teinte::class);
    }


    /**
      * @return Teinte[] Returns an array of Teinte objects
    */

    public function trouveParCouleur($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.couleur = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Teinte[] Returns an array of Teinte objects
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
    public function findOneBySomeField($value): ?Teinte
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
