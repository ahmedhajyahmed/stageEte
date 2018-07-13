<?php

namespace ILANEO\CongeBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="ILANEO\CongeBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     *
     * @ORM\Column(name="user_firstname", type="string", length=255)
     */
    private $userFirstname;
    /**
     * @var string
     *
     * @ORM\Column(name="userLastname", type="string", length=255)
     */
    private $userLastname;

    /**
     * @var int
     *
     * @ORM\Column(name="cin", type="bigint", unique=true)
     */
    private $cin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthDate", type="date")
     */
    private $birthDate;

    /**
     * @var int
     *
     * @ORM\Column(name="phone", type="bigint")
     */
    private $phone;

    /**
     * @var int
     *
     * @ORM\Column(name="paidVacation", type="integer")
     */
    private $paidVacation;

    /**
     * @var int
     *
     * @ORM\Column(name="cnss", type="bigint", unique=true)
     */
    private $cnss;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="recruitmentDate", type="date")
     */
    private $recruitmentDate;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="post", type="string", length=255)
     */
    private $post;
    /**
     * @var float
     *
     * @ORM\Column(name="startingSalary", type="float")
     */
    private $startingSalary;

    /**
     * @var string
     *
     * @ORM\Column(name="familySituation", type="string", length=255)
     */
    private $familySituation;

    /**
     * @var int
     *
     * @ORM\Column(name="children", type="integer")
     */
    private $children;

    /**
     * @var int
     *
     * @ORM\Column(name="registrationNumber", type="bigint", unique=true, nullable=true)
     */
    private $registrationNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="bankAccount", type="bigint")
     */
    private $bankAccount;

    public function __construct()
    {
        parent::__construct();
        $this->paidVacation=0;
        // your own logic
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userLastname
     *
     * @param string $userLastname
     *
     * @return User
     */
    public function setUserLastname($userLastname)
    {
        $this->userLastname = $userLastname;

        return $this;
    }

    /**
     * Get userLastname
     *
     * @return string
     */
    public function getUserLastname()
    {
        return $this->userLastname;
    }

    /**
     * Set cin
     *
     * @param integer $cin
     *
     * @return User
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return int
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set cnss
     *
     * @param integer $cnss
     *
     * @return User
     */
    public function setCnss($cnss)
    {
        $this->cnss = $cnss;

        return $this;
    }

    /**
     * Get cnss
     *
     * @return int
     */
    public function getCnss()
    {
        return $this->cnss;
    }

    /**
     * Set recruitmentDate
     *
     * @param \DateTime $recruitmentDate
     *
     * @return User
     */
    public function setRecruitmentDate($recruitmentDate)
    {
        $this->recruitmentDate = $recruitmentDate;

        return $this;
    }

    /**
     * Get recruitmentDate
     *
     * @return \DateTime
     */
    public function getRecruitmentDate()
    {
        return $this->recruitmentDate;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set post
     *
     * @param string $post
     *
     * @return User
     */
    public function setpost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return string
     */
    public function getPost()
    {
        return $this->post;
    }
    /**
     * Set startingSalary
     *
     * @param float $startingSalary
     *
     * @return User
     */
    public function setStartingSalary($startingSalary)
    {
        $this->startingSalary = $startingSalary;

        return $this;
    }

    /**
     * Get startingSalary
     *
     * @return float
     */
    public function getStartingSalary()
    {
        return $this->startingSalary;
    }

    /**
     * Set familySituation
     *
     * @param string $familySituation
     *
     * @return User
     */
    public function setFamilySituation($familySituation)
    {
        $this->familySituation = $familySituation;

        return $this;
    }

    /**
     * Get familySituation
     *
     * @return string
     */
    public function getFamilySituation()
    {
        return $this->familySituation;
    }

    /**
     * Set children
     *
     * @param integer $children
     *
     * @return User
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Get children
     *
     * @return int
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set registrationNumber
     *
     * @param integer $registrationNumber
     *
     * @return User
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    /**
     * Get registrationNumber
     *
     * @return int
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * Set bankAccount
     *
     * @param integer $bankAccount
     *
     * @return User
     */
    public function setBankAccount($bankAccount)
    {
        $this->bankAccount = $bankAccount;

        return $this;
    }

    /**
     * Get bankAccount
     *
     * @return int
     */
    public function getBankAccount()
    {
        return $this->bankAccount;
    }

    /**
     * Set paidVacation
     *
     * @param integer $paidVacation
     *
     * @return User
     */
    public function setPaidVacation($paidVacation)
    {
        $this->paidVacation = $paidVacation;

        return $this;
    }

    /**
     * Get paidVacation
     *
     * @return integer
     */
    public function getPaidVacation()
    {
        return $this->paidVacation;
    }

    /**
     * Set userFirstname
     *
     * @param string $userFirstname
     *
     * @return User
     */
    public function setUserFirstname($userFirstname)
    {
        $this->userFirstname = $userFirstname;

        return $this;
    }

    /**
     * Get userFirstname
     *
     * @return string
     */
    public function getUserFirstname()
    {
        return $this->userFirstname;
    }
}
