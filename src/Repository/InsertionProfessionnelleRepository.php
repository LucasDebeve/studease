<?php

namespace App\Repository;

use App\Entity\InsertionProfessionnelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InsertionProfessionnelle>
 *
 * @method InsertionProfessionnelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method InsertionProfessionnelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method InsertionProfessionnelle[]    findAll()
 * @method InsertionProfessionnelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InsertionProfessionnelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InsertionProfessionnelle::class);
    }

//    /**
//     * @return InsertionProfessionnelle[] Returns an array of InsertionProfessionnelle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InsertionProfessionnelle
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
