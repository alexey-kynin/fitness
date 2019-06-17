<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package UserBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="user_account")
*/
class UserAccount
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="account")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * @ORM\Column(type="string")
     */
    private $lastName;
//
//
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $gender;


    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $tokenRecover;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

//    /**
//     * Set firstName
//     *
//     * @param string $firstName
//     *
//     * @return UserAccount
//     */
//    public function setFirstName($firstName)
//    {
//        $this->firstName = $firstName;
//
//        return $this;
//    }
//
//    /**
//     * Get firstName
//     *
//     * @return string
//     */
//    public function getFirstName()
//    {
//        return $this->firstName;
//    }
//
    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return UserAccount
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
//
//
//    /**
//     * Set gender
//     *
//     * @param string $gender
//     *
//     * @return UserAccount
//     */
//    public function setGender($gender)
//    {
//        $this->gender = $gender;
//
//        return $this;
//    }
//
//    /**
//     * Get gender
//     *
//     * @return string
//     */
//    public function getGender()
//    {
//        return $this->gender;
//    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return UserAccount
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set tokenRecover
     *
     * @param string $tokenRecover
     *
     * @return UserAccount
     */
    public function setTokenRecover($tokenRecover)
    {
        $this->tokenRecover = $tokenRecover;

        return $this;
    }

    /**
     * Get tokenRecover
     *
     * @return string
     */
    public function getTokenRecover()
    {
        return $this->tokenRecover;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return UserAccount
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
}
