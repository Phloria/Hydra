<?php

namespace App\Repository;

use App\Entity\RoleWebToUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RoleWebToUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoleWebToUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoleWebToUser[]    findAll()
 * @method RoleWebToUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleWebToUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RoleWebToUser::class);
    }

    // /**
    //  * @return RoleWebToUser[] Returns an array of RoleWebToUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RoleWebToUser
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
