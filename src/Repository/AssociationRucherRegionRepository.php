<?php

namespace App\Repository;

use App\Entity\AssociationRucherRegion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssociationRucherRegion|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationRucherRegion|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationRucherRegion[]    findAll()
 * @method AssociationRucherRegion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationRucherRegionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssociationRucherRegion::class);
    }

    // /**
    //  * @return AssociationRucherRegion[] Returns an array of AssociationRucherRegion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AssociationRucherRegion
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
