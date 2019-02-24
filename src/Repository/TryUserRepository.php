<?php

namespace App\Repository;

use App\Entity\TryUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TryUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method TryUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method TryUser[]    findAll()
 * @method TryUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TryUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TryUser::class);
    }

    // /**
    //  * @return TryUser[] Returns an array of TryUser objects
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
    public function findOneBySomeField($value): ?TryUser
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
