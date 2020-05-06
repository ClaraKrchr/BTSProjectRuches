<?php

namespace App\Repository;

use App\Entity\AssociationRucheApiculteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssociationRucheApiculteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationRucheApiculteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationRucheApiculteur[]    findAll()
 * @method AssociationRucheApiculteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationRucheApiculteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssociationRucheApiculteur::class);
    }

    // /**
    //  * @return AssociationRucheApiculteur[] Returns an array of AssociationRucheApiculteur objects
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
    public function findOneBySomeField($value): ?AssociationRucheApiculteur
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
