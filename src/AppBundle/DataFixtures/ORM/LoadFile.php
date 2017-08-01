<?php
/**
 * Created by PhpStorm.
 * User: whoami
 * Date: 17-07-27
 * Time: 3.22.MD
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use UserBundle\Entity\AdmStaffLF;
use UserBundle\Entity\Person;
use UserBundle\Entity\LostObject;


class LoadFile implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $user = new Person();
        $user->setId(1);
        $user->setName("Nail");
        $user->setSurname("Spahija");
        $user->setEmail("nspahija15@epoka.edu.al");
        $user->setPassword("nailspahija");
        $user->setDepartment("CEN2");
        $user->setEnrolledStatus(true);
        $user->setGender("Male");
        $user->setImage("nspahija.jpg");
        $user->setMobphone("0674912156");


        $adm  = new AdmStaffLF();
        $adm->setName("Meitn");
        $adm->setSurname("Pushka");
        $adm->setEmail("mk12@epoka.edu.al");
        $adm ->setAcademicYear("2017");


        $com = new LostObject();
        $com->setDate(new \DateTime('-3 years'));
        $com->setType("wallet");
        $com->setDescription('black with red lines');
        $com->setLostPlace('A building');
        $com->setPerson($user);
        $com->setAdmStafflf($adm);
        // ------------------------------------

        $com1 = new LostObject();
        $com1->setDate(new \DateTime('-1 years'));
        $com1->setType("pen");
        $com1->setDescription('white with blue lines');
        $com1->setLostPlace('A building');
        $com1->setPerson($user);
        $com1->setAdmStafflf($adm);


        $manager->persist($user);
        $manager->persist($com);
        $manager->persist($com1);
        $manager->flush();


    }


}