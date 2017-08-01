<?php
/**
 * Created by PhpStorm.
 * User: whoami
 * Date: 17-08-01
 * Time: 5.46.MD
 */

namespace UserBundle\Repository;


use Doctrine\ORM\EntityRepository;
use UserBundle\Entity\AdmStaffLF;

class AdmStaffRepository extends EntityRepository
{


    public function getOneAdministrator()
    {

        $list_admins = $this->createQueryBuilder("adm_staff")
            ->getQuery()
            ->getOneOrNullResult();

        return $list_admins;

    }





}