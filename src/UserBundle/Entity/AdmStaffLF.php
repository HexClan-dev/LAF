<?php
/**
 * Created by PhpStorm.
 * User: whoami
 * Date: 17-07-31
 * Time: 11.37.PD
 */

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;


/**
 * @ORM\Entity
 * @ORM\Table(name="adm_stafflf")
 */
class AdmStaffLF
{


    public function __construct()
    {
        $this->lostObject = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="string")
     */
    private $email;


    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $surname;


    /**
     * @ORM\Column(type="date")
     */
    private $AcademicYear;


    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\LostObject", mappedBy="admStafflf")
     */
    private $lostObject;


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }



    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return Date
     */
    public function getAcademicYear()
    {
        return $this->AcademicYear;
    }

    /**
     * @param Date $AcademicYear
     */
    public function setAcademicYear($AcademicYear)
    {
        $this->AcademicYear = $AcademicYear;
    }

    /**
     * @return ArrayCollection
     */
    public function getLostObject()
    {
        return $this->lostObject;
    }



}