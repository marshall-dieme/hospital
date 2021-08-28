<?php

namespace App\Repository;

use App\Entity\TypeDiagnostic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeDiagnostic|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDiagnostic|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDiagnostic[]    findAll()
 * @method TypeDiagnostic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDiagnosticRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeDiagnostic::class);
    }

    // /**
    //  * @return TypeDiagnostic[] Returns an array of TypeDiagnostic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeDiagnostic
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
