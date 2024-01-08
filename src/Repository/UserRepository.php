<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @implements PasswordUpgraderInterface<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findWithFormationAndEcole(int $id): ?User
    {
        $qb = $this->createQueryBuilder('u');
        $qb->select('u')
            ->leftJoin('u.formation', 'f')
            ->leftJoin('u.ecole', 'e')
            ->leftJoin('u.localisations', 'l')
            ->leftJoin('u.candidatures', 'c')
            ->addSelect('f')
            ->addSelect('e')
            ->addSelect('l')
            ->addSelect('c')
            ->where('u.id = :id')
            ->setParameter('id', $id);

        $res = $qb->getQuery()->execute();

        if (count($res) > 0) {
            return $res[0];
        } else {
            return null;
        }
    }

    public function users_stats(): array
    {
        $qb = $this->createQueryBuilder('users');
        $qb->select('users.tpUser')
            ->addSelect('COUNT(users.id) as count')
            ->addGroupBy('users.tpUser');

        return $qb->getQuery()->getResult();
    }

    public function findUnverifiedUsers(): array {
        $qb = $this->createQueryBuilder('u');
        $qb->select('u')
            ->where('u.isVerified = false');
        return $qb->getQuery()->execute();
    }

    //    /**
    //     * @return User[] Returns an array of User objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
