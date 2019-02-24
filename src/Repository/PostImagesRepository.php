<?php

namespace App\Repository;

use App\Entity\PostImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PostImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostImages[]    findAll()
 * @method PostImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostImagesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PostImages::class);
    }

    // /**
    //  * @return PostImages[] Returns an array of PostImages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostImages
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
