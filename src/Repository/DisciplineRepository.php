<?php

namespace App\Repository;

use App\Entity\Discipline;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Discipline|null find($id, $lockMode = null, $lockVersion = null)
 * @method Discipline|null findOneBy(array $criteria, array $orderBy = null)
 * @method Discipline[]    findAll()
 * @method Discipline[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisciplineRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Discipline::class);
    }

    // /**
    //  * @return Discipline[] Returns an array of Discipline objects
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
    public function findOneBySomeField($value): ?Discipline
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Discipline[] return an array of orphaned disciplines
     */

    public function getOrphanedDisciplines()
    {

        $results=$this->createQueryBuilder('d')
            ->andWhere('d.family = :val')
            ->setParameter('val', '')
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult() ;
        return ($results);
    }


    /**
     * return disciplines that have not both  english/french description
     */
    public function getDisciplinesNoEnFrDescription(){
        $results=$this->createQueryBuilder('d')
            ->andWhere('d.descriptionEn = :val1')
            ->andWhere('d.descriptionFr = :val2')
            ->setParameter('val1', '')
            ->setParameter('val2', '')
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult() ;
        return ($results);

    }
    /**
     * return disciplines that have no english description
     */
    public function getDisciplinesNoEnDescription(){
        $results=$this->createQueryBuilder('d')
            ->andWhere('d.descriptionEn = :val')
            ->setParameter('val', '')
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult() ;
        return ($results);

    }
    /**
     * return disciplines that have no french description
     */
    public function getDisciplinesNoFrDescription(){
        $results=$this->createQueryBuilder('d')
            ->andWhere('d.descriptionFr = :val')
            ->setParameter('val', '')
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult() ;
        return ($results);

    }

}
