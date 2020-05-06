<?php

namespace App\Repository;

use App\Entity\AssociationRucheRucher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssociationRucheRucher|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationRucheRucher|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationRucheRucher[]    findAll()
 * @method AssociationRucheRucher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationRucheRucherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssociationRucheRucher::class);
    }

    // /**
    //  * @return AssociationRucheRucher[] Returns an array of AssociationRucheRucher objects
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
    public function findOneBySomeField($value): ?AssociationRucheRucher
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
