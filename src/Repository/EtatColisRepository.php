<?php

namespace App\Repository;

use App\Entity\EtatColis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EtatColis>
 *
 * @method EtatColis|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatColis|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatColis[]    findAll()
 * @method EtatColis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatColisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatColis::class);
    }

//    /**
//     * @return EtatColis[] Returns an array of EtatColis objects
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

//    public function findOneBySomeField($value): ?EtatColis
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
