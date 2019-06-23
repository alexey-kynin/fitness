<?php


namespace EventBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * Class Staff
 * @package EventBundle\Entity
 * @ORM\Entity()
 * @ORM\Table(name = "event")
 */
class Event
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;


    /**
     * @ORM\ManyToOne(targetEntity="\StaffBundle\Entity\Staff", inversedBy="event")
     * @ORM\JoinColumn(name="staff_id", referencedColumnName="id")
     */
    private $staff;

    /**
     * @ORM\OneToMany(targetEntity="EventBundle\Entity\UserEvent", mappedBy="event", cascade={"persist", "remove"}, fetch="EXTRA_LAZY")
     */
    private $user;

    public $totalUser;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set staff
     *
     * @param \StaffBundle\Entity\Staff $staff
     *
     * @return Event
     */
    public function setStaff(\StaffBundle\Entity\Staff $staff = null)
    {
        $this->staff = $staff;

        return $this;
    }

    /**
     * Get staff
     *
     * @return \StaffBundle\Entity\Staff
     */
    public function getStaff()
    {
        return $this->staff;
    }


    /**
     * Add user
     *
     * @param User $user
     *
     * @return Event
     */
    public function addUser(User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param User $user
     */
    public function removeUser(User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    public function getTotalUser(){
        return $this->totalUser =$this->getUser()->count();
    }
}
