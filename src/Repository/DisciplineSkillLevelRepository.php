<?php

namespace App\Repository;

use App\Entity\DisciplineSkillLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DisciplineSkillLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method DisciplineSkillLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method DisciplineSkillLevel[]    findAll()
 * @method DisciplineSkillLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisciplineSkillLevelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DisciplineSkillLevel::class);
    }

    // /**
    //  * @return DisciplineSkillLevel[] Returns an array of DisciplineSkillLevel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DisciplineSkillLevel
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
