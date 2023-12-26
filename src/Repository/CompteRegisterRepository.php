<?php

namespace App\Repository;

use App\Entity\CompteRegister;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompteRegister>
 *
 * @method CompteRegister|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteRegister|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteRegister[]    findAll()
 * @method CompteRegister[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteRegisterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteRegister::class);
    }

//    /**
//     * @return CompteRegister[] Returns an array of CompteRegister objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CompteRegister
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
