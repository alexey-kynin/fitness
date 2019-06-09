<?php


namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToOne(targetEntity="\StaffBundle\Entity\Staff", inversedBy="event")
     * @ORM\JoinColumn(name="staff_id", referencedColumnName="id")
     */
    private $staff;


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
}
