<?php

namespace App\Repository;

use App\Entity\Tester;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tester|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tester|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tester[]    findAll()
 * @method Tester[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TesterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tester::class);
    }

    // /**
    //  * @return UserTester[] Returns an array of UserTester objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserTester
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
