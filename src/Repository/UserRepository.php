<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Ldap\Ldap;
use Symfony\Component\Ldap\Adapter\ExtLdap\Adapter;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
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
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getADUsersByUsername($mail)
    {
        $ldap = Ldap::create('ext_ldap', array(
            'host' => 'TN1ADS05',
            'encryption' => 'none',
            'version' => 3,
            'debug' => true,
            'referrals' => false,
        ));
        $filter="(&(mail=$mail*))";
        $ldap->bind('SA_KenLDAP', 'LDS@ken01');
        $query = $ldap->query('ou=Regional,dc=ad,dc=linedata,dc=com', $filter);
        $results = $query->execute();
      // echo '<pre>';print_r($results[0]->getAttributes());die;
        foreach($results as $result){
            $index=$result->getAttributes()['mail'][0];
            $array[$index]=$result->getAttributes()['mail'][0];
        }


        return $array;
    }
}
