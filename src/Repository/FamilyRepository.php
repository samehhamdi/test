<?php

namespace App\Repository;

use App\Entity\Family;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Family|null find($id, $lockMode = null, $lockVersion = null)
 * @method Family|null findOneBy(array $criteria, array $orderBy = null)
 * @method Family[]    findAll()
 * @method Family[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FamilyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Family::class);
    }

    // /**
    //  * @return Family[] Returns an array of Family objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Family
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * return families that have not both  english/french description
     */
    public function getFamiliesNoEnFrDescription(){
        $results=$this->createQueryBuilder('f')
            ->andWhere('f.descriptionEn = :val1')
            ->andWhere('f.descriptionFr = :val2')
            ->setParameter('val1', '')
            ->setParameter('val2', '')
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult() ;
        return ($results);

    }
    /**
     * return families that have no english description
     */
    public function getFamiliesNoEnDescription(){
        $results=$this->createQueryBuilder('f')
            ->andWhere('f.descriptionEn = :val')
            ->setParameter('val', '')
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult() ;
        return ($results);

    }
    /**
     * return families that have no french description
     */
    public function getFamiliesNoFrDescription(){
        $results=$this->createQueryBuilder('f')
            ->andWhere('f.descriptionFr = :val')
            ->setParameter('val', '')
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult() ;
        return ($results);

    }
}
