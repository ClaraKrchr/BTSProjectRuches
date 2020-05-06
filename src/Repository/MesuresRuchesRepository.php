<?php

namespace App\Repository;

use App\Entity\MesuresRuches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MesuresRuches|null find($id, $lockMode = null, $lockVersion = null)
 * @method MesuresRuches|null findOneBy(array $criteria, array $orderBy = null)
 * @method MesuresRuches[]    findAll()
 * @method MesuresRuches[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MesuresRuchesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MesuresRuches::class);
    }

    // /**
    //  * @return MesuresRuches[] Returns an array of MesuresRuches objects
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
    public function findOneBySomeField($value): ?MesuresRuches
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
