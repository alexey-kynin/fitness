<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 23.05.2019
 * Time: 16:32
 */

namespace UserBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Acl\Exception\Exception;
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
     * @ORM\Column(type="string")
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
     * @ORM\Column(type="date")
     */
    private $birthday;


    /**
     * @var ArrayCollection
         * @ORM\ManyToMany(targetEntity="Roles", inversedBy="users", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *      name="user_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    private $roles;

    /**
     * @ORM\Column(type="string")
     */
    private $phone;

    /**
     * @ORM\Column(type="string")
     */
    private $gender;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    private $plainPassword;

    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\UserAccount", mappedBy="user", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="$account", referencedColumnName="id")
     */
    private $account;



    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->status = 1;

        $this->salt = md5(uniqid(null, TRUE));
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

//    /**
//     * @param mixed $plainPassword
//     */
//    public function setPlainPassword($plainPassword)
//    {
//        $this->plainPassword = $plainPassword;
//        $this->password = null;
//    }

    /**
     * @param mixed $password
     */
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
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
    }

    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
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
        return serialize([
            $this->id,
            $this->username,
            $this->password,
        ]);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
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
        if ( !$this->existRole($role) );
        $this->roles->add($role);
    }

    public function existRole(\UserBundle\Entity\Roles $role)
    {
        foreach($this->roles as $temp)
        {
            if ( $role->getID() === $temp->getId() )
                return true;
        }
        return false;
    }


    /**
     * Remove role
     *
     * @param \UserBundle\Entity\Roles $role
     */
    public function removeRole(\UserBundle\Entity\Roles $role)
    {
        $this->roles->removeElement($role);
        $role->setRole($this);
    }

//    /**
//     * @return string
//     */
//    public function getRolesAsString()
//    {
//        $roles = array();
//        foreach ($this->getRoles() as $role) {
//            $role = explode('_', $role);
//            array_shift($role);
//            $roles[] = ucfirst(strtolower(implode(' ', $role)));
//        }
//
//        return implode(', ', $roles);
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

//    public function getFullName()
//    {
//        $fillName = $this->getAccount()->getFirstName();
//        $lastName = $this->getAccount()->getLastName();
//        if($lastName){
//            $fillName = $fillName." ".$lastName;
//        }
//        return $fillName;
//
//    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    function random_str(
        $length,
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ) {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }

    function rand_string( $length ) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);

    }
}
