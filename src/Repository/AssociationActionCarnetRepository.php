<?php

namespace App\Repository;

use App\Entity\AssociationActionCarnet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssociationActionCarnet|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationActionCarnet|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationActionCarnet[]    findAll()
 * @method AssociationActionCarnet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationActionCarnetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssociationActionCarnet::class);
    }

    // /**
    //  * @return AssociationActionCarnet[] Returns an array of AssociationActionCarnet objects
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
    public function findOneBySomeField($value): ?AssociationActionCarnet
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
