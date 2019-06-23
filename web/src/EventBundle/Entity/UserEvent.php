<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 18.06.2019
 * Time: 12:24
 */

namespace EventBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Staff
 * @package EventBundle\Entity
 * @ORM\Entity()
 * @ORM\Table(name="user_event",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="unique_data",columns={"user_id", "event_id"})
 *      })
 */
class UserEvent
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="event", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Event", inversedBy="user")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;

    /**
     * @ORM\Column(type="string")
     */
    private $subscribe;

//    /**
//     * @ORM\Column(type="boolean", options={"default":"0"})
//     */
//    private $byEmail;
//
//    /**
//     * @ORM\Column(type="boolean", options={"default":"0"})
//     */
//    private $byPhone;

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
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return UserEvent
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
     * Set event
     *
     * @param \EventBundle\Entity\Event $event
     *
     * @return UserEvent
     */
    public function setEvent(\EventBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \EventBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }



    /**
     * Set byEmail
     *
     * @param boolean $byEmail
     *
     * @return UserEvent
     */
    public function setByEmail($byEmail)
    {
        $this->byEmail = $byEmail;

        return $this;
    }

    /**
     * Get byEmail
     *
     * @return boolean
     */
    public function getByEmail()
    {
        return $this->byEmail;
    }

    /**
     * Set byPhone
     *
     * @param boolean $byPhone
     *
     * @return UserEvent
     */
    public function setByPhone($byPhone)
    {
        $this->byPhone = $byPhone;

        return $this;
    }

    /**
     * Get byPhone
     *
     * @return boolean
     */
    public function getByPhone()
    {
        return $this->byPhone;
    }

    /**
     * Set subscribe
     *
     * @param string $subscribe
     *
     * @return UserEvent
     */
    public function setSubscribe($subscribe)
    {
        $this->subscribe = $subscribe;

//        return $this;
    }

    /**
     * Get subscribe
     *
     * @return string
     */
    public function getSubscribe()
    {
        return $this->subscribe;
    }

    public function getTotalUser(){
        return $this->getUser()->count();
    }

}
