<?php

namespace App\Repository;

use App\Entity\AssocierRuchePort;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssocierRuchePort|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssocierRuchePort|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssocierRuchePort[]    findAll()
 * @method AssocierRuchePort[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssocierRuchePortRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssocierRuchePort::class);
    }

    // /**
    //  * @return AssocierRuchePort[] Returns an array of AssocierRuchePort objects
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
    public function findOneBySomeField($value): ?AssocierRuchePort
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
