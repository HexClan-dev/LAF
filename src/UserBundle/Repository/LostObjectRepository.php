<?php
/**
 * Created by PhpStorm.
 * User: whoami
 * Date: 17-07-28
 * Time: 10.08.PD
 */

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Acl\Exception\Exception;
use UserBundle\Entity\LostObject;
use UserBundle\Entity\Person;

class LostObjectRepository extends EntityRepository
{


    public function getCommentsFromDB()
    {
 /*       return $this->createQueryBuilder('u')
            ->getQuery()
            ->getArrayResult();
 */
    }


    public function getAllCommentsFromUser(Person $user)
    {/*
        return $this->createQueryBuilder('u')
            ->where('u.person = :user')
            ->setParameter('user',$user.getId())
            ->getQuery()
            ->getArrayResult();
    */
    }


    // deleting an objec tusing the entity manager directly

    public function DeleteLOSTOBJwithId(LostObject $lostObject)
    {
        $em = $this->getEntityManager();

        try {
            $em->remove($lostObject);

            $em->flush();
        }catch (Exception $e)
        {
            $em->rollback();
        }
    }





}