<?php

namespace App\Repository;

use App\Entity\Testtt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Testtt>
 *
 * @method Testtt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Testtt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Testtt[]    findAll()
 * @method Testtt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestttRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Testtt::class);
    }

//    /**
//     * @return Testtt[] Returns an array of Testtt objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Testtt
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
