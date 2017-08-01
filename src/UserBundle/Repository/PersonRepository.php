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
use UserBundle\Entity\Person;

class PersonRepository extends EntityRepository
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



}