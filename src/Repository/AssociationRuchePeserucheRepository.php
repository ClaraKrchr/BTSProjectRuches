<?php

namespace App\Repository;

use App\Entity\AssociationRuchePeseruche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssociationRuchePeseruche|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationRuchePeseruche|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationRuchePeseruche[]    findAll()
 * @method AssociationRuchePeseruche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationRuchePeserucheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssociationRuchePeseruche::class);
    }

    // /**
    //  * @return AssociationRuchePeseruche[] Returns an array of AssociationRuchePeseruche objects
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
    public function findOneBySomeField($value): ?AssociationRuchePeseruche
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
