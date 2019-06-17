<?php

namespace StaffBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Staff
 * @package StaffBundle\Entity
 * @ORM\Entity()
 * @ORM\Table(name = "staff")
 */
class Staff
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="EventBundle\Entity\Event", mappedBy="staff", cascade={"persist", "remove"})
     */
    private $event;

    public function __toString()
    {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     *
     * @return Staff
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set event
     *
     * @param \EventBundle\Entity\Event $event
     *
     * @return Staff
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
     * Constructor
     */
    public function __construct()
    {
        $this->event = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add event
     *
     * @param \EventBundle\Entity\Event $event
     *
     * @return Staff
     */
    public function addEvent(\EventBundle\Entity\Event $event)
    {
        $this->event[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \EventBundle\Entity\Event $event
     */
    public function removeEvent(\EventBundle\Entity\Event $event)
    {
        $this->event->removeElement($event);
    }
}
