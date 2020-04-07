<?php

namespace App\Repository;

use App\Entity\CApiculteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CApiculteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method CApiculteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method CApiculteur[]    findAll()
 * @method CApiculteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CApiculteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CApiculteur::class);
    }

    // /**
    //  * @return CApiculteur[] Returns an array of CApiculteur objects
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
    public function findOneBySomeField($value): ?CApiculteur
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
