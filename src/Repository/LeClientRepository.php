<?php

namespace App\Repository;

use App\Entity\LeClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LeClient>
 *
 * @method LeClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeClient[]    findAll()
 * @method LeClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LeClient::class);
    }

//    /**
//     * @return LeClient[] Returns an array of LeClient objects
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

//    public function findOneBySomeField($value): ?LeClient
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
