<?php

namespace App\Repository;

use App\Entity\Enrollment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Mission;

/**
 * @method Enrollment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Enrollment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Enrollment[]    findAll()
 * @method Enrollment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnrollmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Enrollment::class);
    }


    public function findByMission(Mission $mission)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.missionChoice01 = :mission or e.missionChoice02 = :mission ')
            ->setParameter('mission', $mission->getId())
            ->orderBy('e.email', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Enrollment[] Returns an array of Enrollment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Enrollment
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
