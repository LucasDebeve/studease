<?php

namespace App\Repository;

use App\Entity\Localisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Localisation>
 *
 * @method Localisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Localisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Localisation[]    findAll()
 * @method Localisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocalisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Localisation::class);
    }

    public function findWithInsertions(int $id): ?Localisation
    {
        $qb = $this->createQueryBuilder('l')
            ->addSelect('i')
            ->leftJoin('l.insertionProfessionnelles', 'i')
            ->where('l.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
        ;

        $res = $qb->execute();
        if (count($res) > 0) {
            return $res[0];
        }

        return null;
    }

    //    /**
    //     * @return Localisation[] Returns an array of Localisation objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Localisation
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
