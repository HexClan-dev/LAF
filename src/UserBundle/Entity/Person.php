<?php
/**
 * Created by PhpStorm.
 * User: whoami
 * Date: 17-07-27
 * Time: 2.17.MD
 */

namespace UserBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * @ORM\Entity(repositoryClass="UserBundle\Repository\PersonRepository")
 * @ORM\Table(name="person")
 */
class Person implements UserInterface
{


    public function __construct()
    {
        $this->lostObject = new ArrayCollection();
    }


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=45)
     */
    private $name;

    /**
     * @ORM\Column(type="string",length=45)
     */
    private $surname;


    /**
     * @ORM\Column(type="string",unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string",length=35)
     */
    private $password;


    /**
     * @ORM\Column(type="string", length=8)
     */
    private $department;


    /**
     * @ORM\Column(type="string",length=10)
     */
    private $gender;


    /**
     * @ORM\Column(type="integer", length=15)
     */
    private $mobphone;


    /**
     * @ORM\Column(type="boolean")
     */
    private $enrolledStatus;


    /**
     * @ORM\Column(type="string")
     */
    private $image;



    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\LostObject", mappedBy="person")
     * @ORM\JoinTable(
     *      joinColumns={@ORM\JoinColumn(onDelete="CASCADE")})
     */
    private $lostObject;

    /**
     * @ORM\Column(type="json_array", nullable=false)
     */
    private $roles;



    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }


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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
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
     * @return mixed
     */
    public function getMobphone()
    {
        return $this->mobphone;
    }

    /**
     * @param mixed $mobphone
     */
    public function setMobphone($mobphone)
    {
        $this->mobphone = $mobphone;
    }

    /**
     * @return mixed
     */
    public function getEnrolledStatus()
    {
        return $this->enrolledStatus;
    }

    /**
     * @param mixed $enrolledStatus
     */
    public function setEnrolledStatus($enrolledStatus)
    {
        $this->enrolledStatus = $enrolledStatus;
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
     * @return ArrayCollection
     */
    public function getLostObject()
    {
        return $this->lostObject;
    }


    public function setPassword($pass)
    {
        $this->password = $pass;
    }


    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param mixed $department
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    }



    /**@param  string[] $arr */
    public function setRoles($arr)
    {
        $this->roles = $arr;
    }

    /**
     * @return string[]
     */
    public function getRoles()
    {
        if(!in_array("ROLE_USER",$this->roles))
            $this->roles[] = "ROLE_USER";

        return  $this->roles;
    }

    /**
     * @return string The password
     */
    public function getPassword()
    {
        return $this->getPassword();
    }

    /**
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;

    }

    public function setUsername($email)
    {
        $this->email= $email;
    }

    /**
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }


    public function eraseCredentials()
    {

    }


    public function __toString()
    {
        return $this->id." ".$this->name." ".$this->surname." ".$this->email." ".$this->roles." ";
    }

//
//    /**
//     * String representation of object
//     * @link http://php.net/manual/en/serializable.serialize.php
//     * @return string the string representation of the object or null
//     * @since 5.1.0
//     */
//    public function serialize()
//    {
//
//
//        return serialize(
//            array(
//                $this->id,
//                $this->email,
//                $this->password,
//                $this->roles
//            )
//        );
//
//
//    }
//
//    /**
//     * Constructs the object
//     * @link http://php.net/manual/en/serializable.unserialize.php
//     * @param string $serialized <p>
//     * The string representation of the object.
//     * </p>
//     * @return void
//     * @since 5.1.0
//     */
//    public function unserialize($serialized)
//    {
//
//        list(
//            $this->id,
//            $this->email,
//            $this->password,
//            $this->roles
//            ) = unserialize($serialized);
//
//    }

}