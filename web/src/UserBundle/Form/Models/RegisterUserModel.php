<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 29.05.2019
 * Time: 17:29
 */

namespace UserBundle\Form\Models;

use CoreBundle\Core\Core;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use UserBundle\Entity\User;
use UserBundle\Entity\UserAccount;

class RegisterUserModel
{
    public $firstName;

    public $lastName;

    public $email;

    public $password;

    public $birthday;

    public $gender;

    public $phone;

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

//    /**
//     * @var UserPasswordEncoder
//     */
//    private $passwordEncoder;
//
//    public function __construct(UserPasswordEncoder $passwordEncoder)
//    {
//        $this->passwordEncoder = $passwordEncoder;
//    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

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

    public function getUserHandler()
    {
        $user = new User();
        $account = new UserAccount();
        $account->setFirstName($this->firstName);
        $account->setLastName($this->lastName);
        $account->setBirthday($this->birthday);
        $account->setGender($this->gender);
        $user->setEmail($this->email);
        $user->setPhone($this->phone);
        $user->setAccount($account);

        $encoder = Core::service('security.password_encoder');
        $password = $encoder->encodePassword($user, $this->password);
        $user->setPassword($password);

        return $user;
    }
    
}