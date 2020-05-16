<?php

namespace App\Repository;

use App\Entity\AssociationRucheCarnet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssociationRucheCarnet|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationRucheCarnet|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationRucheCarnet[]    findAll()
 * @method AssociationRucheCarnet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationRucheCarnetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssociationRucheCarnet::class);
    }

    // /**
    //  * @return AssociationRucheCarnet[] Returns an array of AssociationRucheCarnet objects
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
    public function findOneBySomeField($value): ?AssociationRucheCarnet
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
