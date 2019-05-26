<?php

namespace App\Repository;

use App\Entity\RoleWeb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RoleWeb|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoleWeb|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoleWeb[]    findAll()
 * @method RoleWeb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleWebRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RoleWeb::class);
    }

    // /**
    //  * @return RoleWeb[] Returns an array of RoleWeb objects
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
    public function findOneBySomeField($value): ?RoleWeb
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
