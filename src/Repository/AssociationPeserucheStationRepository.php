<?php

namespace App\Repository;

use App\Entity\AssociationPeserucheStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssociationPeserucheStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationPeserucheStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationPeserucheStation[]    findAll()
 * @method AssociationPeserucheStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationPeserucheStationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssociationPeserucheStation::class);
    }

    // /**
    //  * @return AssociationPeserucheStation[] Returns an array of AssociationPeserucheStation objects
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
    public function findOneBySomeField($value): ?AssociationPeserucheStation
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
