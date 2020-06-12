<?php

namespace App\Repository;

use App\Entity\AssocierRucheApiculteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssocierRucheApiculteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssocierRucheApiculteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssocierRucheApiculteur[]    findAll()
 * @method AssocierRucheApiculteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssocierRucheApiculteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssocierRucheApiculteur::class);
    }

    // /**
    //  * @return AssocierRucheApiculteur[] Returns an array of AssocierRucheApiculteur objects
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
    public function findOneBySomeField($value): ?AssocierRucheApiculteur
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
