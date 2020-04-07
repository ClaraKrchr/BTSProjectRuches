<?php

namespace App\Repository;

use App\Entity\Stop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Stop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stop[]    findAll()
 * @method Stop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stop::class);
    }

    // /**
    //  * @return Stop[] Returns an array of Stop objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stop
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
