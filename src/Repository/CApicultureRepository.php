<?php

namespace App\Repository;

use App\Entity\CApiculture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CApiculture|null find($id, $lockMode = null, $lockVersion = null)
 * @method CApiculture|null findOneBy(array $criteria, array $orderBy = null)
 * @method CApiculture[]    findAll()
 * @method CApiculture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CApicultureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CApiculture::class);
    }

    // /**
    //  * @return CApiculture[] Returns an array of CApiculture objects
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
    public function findOneBySomeField($value): ?CApiculture
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
