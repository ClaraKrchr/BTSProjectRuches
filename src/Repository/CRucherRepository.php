<?php

namespace App\Repository;

use App\Entity\CRucher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CRucher|null find($id, $lockMode = null, $lockVersion = null)
 * @method CRucher|null findOneBy(array $criteria, array $orderBy = null)
 * @method CRucher[]    findAll()
 * @method CRucher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CRucherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CRucher::class);
    }

    // /**
    //  * @return CRucher[] Returns an array of CRucher objects
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
    public function findOneBySomeField($value): ?CRucher
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
