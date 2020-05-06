<?php

namespace App\Repository;

use App\Entity\MesuresStations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MesuresStations|null find($id, $lockMode = null, $lockVersion = null)
 * @method MesuresStations|null findOneBy(array $criteria, array $orderBy = null)
 * @method MesuresStations[]    findAll()
 * @method MesuresStations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MesuresStationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MesuresStations::class);
    }

    // /**
    //  * @return MesuresStations[] Returns an array of MesuresStations objects
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
    public function findOneBySomeField($value): ?MesuresStations
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
