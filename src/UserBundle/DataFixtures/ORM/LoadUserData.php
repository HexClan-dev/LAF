<?php
/**
 * Created by PhpStorm.
 * User: whoami
 * Date: 17-08-15
 * Time: 12.02.PD
 */

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\Person;


class LoadUserData implements FixtureInterface
{



    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */

    public function load(ObjectManager $manager)
    {

        $user = new Person();
        $user->setName('Nail');
        $user->setSurname('Spahija');
        $user->setEmail('nspahija15@epoka.edu.al');
        $user->setPassword('nailspahija');
        $user->setRoles(['ROLE_USER']);
        $user->setMobphone(012341341234);
        $user->setGender('male');
        $user->setImage('nspahija.jpg');
        $user->setDepartment('Cen');
        $user->setEnrolledStatus(true);


        $manager->persist($user);
        $manager->flush();

    }
}