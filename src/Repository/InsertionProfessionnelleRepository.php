<?php

namespace App\Repository;

use App\Entity\InsertionProfessionnelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query\Parameter;
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

    /**
     * @return array InsertionProfessionnelle[]
     */
    public function search(array $filters): array
    {
        $parameters = new ArrayCollection([]);
        $qb = $this->createQueryBuilder('insertion')
            ->leftJoin('insertion.localisation', 'localisation')
            ->leftJoin('localisation.entreprise', 'company')
            ->addSelect('localisation')
            ->addSelect('company');
        if ('' != $filters['intitule']) {
            $qb->andWhere($qb->expr()->like('insertion.titre', ':intitule'));
            $intitule = $filters['intitule'];
            $parameters->add(new Parameter('intitule', '%'.$intitule.'%'));
        }
        if ('stage' == $filters['type_contrat']) {
            $qb->andWhere('insertion.typePro = 1');
        } elseif ('alternance' == $filters['type_contrat']) {
            $qb->andWhere('insertion.typePro = 2');
        }
        if ('' != $filters['duree']) {
            $duree = intval($filters['duree']);
            $qb->andWhere('insertion.duree <= :duree_max')
                ->andWhere('insertion.duree >= :duree_min');
            $parameters->add(new Parameter('duree_max', $duree + 7));
            $parameters->add(new Parameter('duree_min', $duree - 7));
        }
        if ('company' == $filters['order_by']) {
            $qb->orderBy('company.name');
        } elseif ('insertion' == $filters['order_by']) {
            $qb->orderBy('insertion.titre');
        } elseif ('duree' == $filters['order_by']) {
            $qb->orderBy('insertion.duree');
        } else {
            $qb->orderBy('insertion.id');
        }
        $qb->setParameters($parameters);

        return $qb->getQuery()->getResult();
    }

    public function findByCompany(int $id): array
    {
        $qb = $this->createQueryBuilder('insertion');
        $qb->select('insertion')
            ->leftJoin('insertion.localisation', 'localisation')
            ->leftJoin('localisation.entreprise', 'company')
            ->addSelect('localisation')
            ->addSelect('company')
            ->andWhere('company.id = :id')
            ->setParameter('id', $id)
            ->orderBy('insertion.dateDeb', 'DESC');

        return $qb->getQuery()->getArrayResult();
    }

    public function findWithCompanyAndLocalisation(int $id): ?InsertionProfessionnelle
    {
        $qb = $this->createQueryBuilder('insertion');
        $qb->select('insertion')
            ->leftJoin('insertion.localisation', 'localisation')
            ->leftJoin('localisation.entreprise', 'company')
            ->addSelect('company')
            ->addSelect('localisation')
            ->andWhere('insertion.id = :id')
            ->setParameter('id', $id);

        $res = $qb->getQuery()->getResult();
        if (count($res) > 0) {
            return $res[0];
        } else {
            return null;
        }
    }

    public function getRecommandationsWithCompany(int $id): array
    {
        $qb = $this->createQueryBuilder('insertion');
        $qb->select('insertion')
            ->leftJoin('insertion.localisation', 'localisation')
            ->leftJoin('localisation.entreprise', 'company')
            ->addSelect('localisation')
            ->addSelect('company')
            ->andWhere('insertion.id != :id')
            ->setParameter('id', $id)
            ->orderBy('insertion.dateDeb', 'DESC')
            ->setMaxResults(4);

        return $qb->getQuery()->getArrayResult();
    }

    public function general_stats(): array
    {
        $qb = $this->createQueryBuilder('insertions');
        $qb->select('insertions.typePro')
            ->addSelect('COUNT(insertions.id) as count')
            ->addSelect('COUNT(candidatures.id) as count_candidatures')
            ->leftJoin('insertions.candidatures', 'candidatures')
            ->addGroupBy('insertions.typePro');

        return $qb->getQuery()->getResult();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findWithCandidaturesAndCandidats(int $id): ?InsertionProfessionnelle
    {
        $qb = $this->createQueryBuilder('insertion');
        $qb->select('insertion')
            ->leftJoin('insertion.candidatures', 'candidature')
            ->leftJoin('candidature.candidat', 'candidat')
            ->andWhere('insertion.id = :id')
            ->addSelect('candidature')
            ->addSelect('candidat')
            ->orderBy('candidature.date', 'ASC')
            ->addOrderBy('candidat.name', 'ASC')
            ->setParameter('id', $id);

        $res = $qb->getQuery()->execute();

        if (count($res) > 0) {
            return $res[0];
        } else {
            return null;
        }
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
