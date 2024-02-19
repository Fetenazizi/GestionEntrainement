<?php

namespace App\Repository;

use App\Entity\Entrainements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Entrainements>
 *
 * @method Entrainements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entrainements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entrainements[]    findAll()
 * @method Entrainements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrainementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entrainements::class);
    }

//    /**
//     * @return Entrainements[] Returns an array of Entrainements objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Entrainements
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
