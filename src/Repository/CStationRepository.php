<?php

namespace App\Repository;

use App\Entity\CStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CStation[]    findAll()
 * @method CStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CStationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CStation::class);
    }

    // /**
    //  * @return CStation[] Returns an array of CStation objects
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
    public function findOneBySomeField($value): ?CStation
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
