<?php

namespace App\Repository;

use App\Entity\MesuresPeseruches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MesuresPeseruches|null find($id, $lockMode = null, $lockVersion = null)
 * @method MesuresPeseruches|null findOneBy(array $criteria, array $orderBy = null)
 * @method MesuresPeseruches[]    findAll()
 * @method MesuresPeseruches[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MesuresPeseruchesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MesuresPeseruches::class);
    }

    // /**
    //  * @return MesuresPeseruches[] Returns an array of MesuresPeseruches objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MesuresPeseruches
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
