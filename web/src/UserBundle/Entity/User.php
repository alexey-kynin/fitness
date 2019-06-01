<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 23.05.2019
 * Time: 16:32
 */

namespace UserBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package UserBundle\Entity
 * @ORM\Entity(repositoryClass="UserBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User implements \Serializable, UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $salt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birth;

//    /**
//     * @ORM\Column(type="string")
//     */
//    private $sex;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Roles", inversedBy="users", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_roles")
     */
    private $roles;

    /**
     * @ORM\Column(type="string")
     */
    private $phone;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    private $plainPassword;

    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\UserAccount", mappedBy="user", cascade={"persist", "remove"})
     */
    private $account;




//    private $entities123 12 ;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->birth = new \DateTime();
        $this->status = 1;

        $this->salt = md5(uniqid(null, TRUE));
        $this->username = md5(uniqid(null, TRUE));
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;
    }


     /**
     * @return mixed
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
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @param mixed $birth
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
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

//    /**
//     * @return mixed
//     */
//    public function getRole()
//    {
//        return $this->role;
//    }
//
//    /**
//     * @param mixed $role
//     */
//    public function setRole($role)
//    {
//        $this->role = $role;
//    }

//    /**
//     * @return mixed
//     */
//    public function getSex()
//    {
//        return $this->sex;
//    }
//
//    /**
//     * @param mixed $sex
//     */
//    public function setSex($sex)
//    {
//        $this->sex = $sex;
//    }

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

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getRoles()
    {
        return $this->roles->toArray();
//        return ['ROLE_USER'];
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function serialize()
    {
//        return serialize([$this->id]);

        return serialize([
            $this->id,
            $this->username,
//            $this->password,
        ]);
    }

    public function unserialize($serialized)
    {
//        list($this->id) = $this->unserialize($serialized);
        list (
            $this->id,
            $this->username,
//            $this->password,
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }


    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        /**Кынин. Обнуляем переменную после входа в систему*/
        $this->password = $password;

        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Add role
     *
     * @param \UserBundle\Entity\Roles $role
     *
     * @return User
     */
    public function addRole(\UserBundle\Entity\Roles $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \UserBundle\Entity\Roles $role
     */
    public function removeRole(\UserBundle\Entity\Roles $role)
    {
        $this->roles->removeElement($role);
    }

//    public function setEntities($entity, $machine_name)
//    {
//        $this->entities[$machine_name] = $entity;
//    }
//
//    public function getEntities($machine_name)
//    {
//        return isset($this->entities[$machine_name]) ? $this->entities[$machine_name] : null;
//    }

    /**
     * Set account
     *
     * @param \UserBundle\Entity\UserAccount $account
     *
     * @return User
     */
    public function setAccount(\UserBundle\Entity\UserAccount $account = null)
    {
        $this->account = $account;
        $account->setUser($this);

        return $this;
    }

    /**
     * Get account
     *
     * @return \UserBundle\Entity\UserAccount
     */
    public function getAccount()
    {
        return $this->account;
    }

    public function getFullname()
    {
        $fillName = $this->getAccount()->getFirstName();
        $lastName = $this->getAccount()->getLastName();
        if($lastName){
            $fillName = $fillName." ".$lastName;
        }
        return $fillName;

    }
}
