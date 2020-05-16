<?php

namespace App\Repository;

use App\Entity\AssociationApiculteurCarnet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssociationApiculteurCarnet|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationApiculteurCarnet|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationApiculteurCarnet[]    findAll()
 * @method AssociationApiculteurCarnet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationApiculteurCarnetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssociationApiculteurCarnet::class);
    }

    // /**
    //  * @return AssociationApiculteurCarnet[] Returns an array of AssociationApiculteurCarnet objects
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
    public function findOneBySomeField($value): ?AssociationApiculteurCarnet
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
