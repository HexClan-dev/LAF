<?php
/**
 * Created by PhpStorm.
 * User: whoami
 * Date: 17-07-27
 * Time: 2.24.MD
 */

namespace UserBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass="UserBundle\Repository\LostObjectRepository")
 * @ORM\Table(name="lostObject")
 */
class LostObject
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;


    /**
     * @ORM\Column(type="string",length=150)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Person" , inversedBy="lostObject")
     * @ORM\JoinColumn(onDelete="restrict")
     */
    private $person;


    /**
     * @ORM\Column(type="string")
     */
    private $lostPlace;


    /**
     * @ORM\Column(type="boolean")
     */
    private $isFound=false;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\AdmStaffLF", inversedBy="lostObject",cascade={"persist"})
     *
     */
    private $admStafflf;

    /**
     * @return string
     */
    public function getLostPlace()
    {
        return $this->lostPlace;
    }

    /**
     * @param string $lostPlace
     */
    public function setLostPlace($lostPlace)
    {
        $this->lostPlace = $lostPlace;
    }

    /**
     * @param mixed $admStafflf
     */
    public function setAdmStafflf($admStafflf)
    {
        $this->admStafflf = $admStafflf;
    }

    /**
     * @return bool
     */
    public function getisFound()
    {
        return $this->isFound;
    }

    /**
     * @param bool $isFound
     */
    public function setIsFound($isFound)
    {
        $this->isFound = $isFound;
    }


    /**
     * @return AdmStaffLF $admStaff[]
     */
    public function getAdmStaffLF()
    {
        return $this->admStafflf;
    }


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return text
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $text
     */
    public function setDescription($text)
    {
        $this->description = $text;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getPerson()
    {
        return $this->person;
    }


    /**
     * @param Person $user
     */
    public function setPerson(Person $user)
    {
        $this->person = $user;
    }


    public function __toString()
    {
        return sprintf("%s , %s , %s",$this->id,$this->person,$this->date);
    }
}