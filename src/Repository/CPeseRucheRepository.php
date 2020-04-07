<?php

namespace App\Repository;

use App\Entity\CPeseRuche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CPeseRuche|null find($id, $lockMode = null, $lockVersion = null)
 * @method CPeseRuche|null findOneBy(array $criteria, array $orderBy = null)
 * @method CPeseRuche[]    findAll()
 * @method CPeseRuche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CPeseRucheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CPeseRuche::class);
    }

    // /**
    //  * @return CPeseRuche[] Returns an array of CPeseRuche objects
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
    public function findOneBySomeField($value): ?CPeseRuche
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
