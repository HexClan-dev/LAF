<?php
/**
 * Created by PhpStorm.
 * User: whoami
 * Date: 17-07-27
 * Time: 8.04.MD
 */

namespace UserBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Command\Proxy\QueryRegionCacheDoctrineCommand;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\Security\Core\User\UserInterface;
use UserBundle\Entity\Person;

class PersonRepository extends EntityRepository implements UserLoaderInterface
{

    /**
     * @return Person[]
     */
    public function getUsersFromDB()
    {

        $query = $this->createQueryBuilder('person')
            ->getQuery()
            ->getArrayResult();

        return $query;

    }



    public function getWithUsernameAndThePassword($username, $password)
    {

        $quer = $this->createQueryBuilder('person')
            ->where('person.email = :email')
            ->setParameter("email",$username)
            ->andWhere('person.password = :password')
            ->setParameter('password',$password)
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();

        return $quer;

    }


    /**
     * @param integer $id
     */

    public function searchWithAnId($id)
    {

        $querry = $this->createQueryBuilder("person")
            ->where("person.id = :id")
            ->setParameter("id",$id)
            ->getQuery()
            ->getOneOrNullResult();
        // or ->execute for many of those

        return $querry;

    }


    /**
     * Loads the user for the given username.
     *
     * This method must return null if the user is not found.
     *
     * @param string $username The username
     *
     * @return UserInterface|null
     */

    public function loadUserByUsername($username)
    {

        return $this->createQueryBuilder('person')
            ->where("person.email = :username")
            ->setParameter('username',$username)
            ->getQuery()
            ->getOneOrNullResult();

    }
}