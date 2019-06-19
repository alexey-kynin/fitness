<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 18.06.2019
 * Time: 16:35
 */

namespace EventBundle\Form\Models;


use EventBundle\Entity\UserEvent;

class SubscribeToEventModel
{
//    private $byEmail;
//
//    private $byPhone;

    private $subscribe;

    /**
     * @return mixed
     */
    public function getSubscribe()
    {
        return $this->subscribe;
    }

    /**
     * @param mixed $subscribe
     */
    public function setSubscribe($subscribe)
    {
        $this->subscribe = $subscribe;
    }

//    /**
//     * @return mixed
//     */
//    public function getByEmail()
//    {
//        return $this->byEmail;
//    }
//
//    /**
//     * @param mixed $byEmail
//     */
//    public function setByEmail($byEmail)
//    {
//        $this->byEmail = $byEmail;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getByPhone()
//    {
//        return $this->byPhone;
//    }
//
//    /**
//     * @param mixed $byPhone
//     */
//    public function setByPhone($byPhone)
//    {
//        $this->byPhone = $byPhone;
//    }

    public function subscribeUser($user, $event)
    {
        $userEvent = new UserEvent();

        $userEvent->setUser($user);
        $userEvent->setEvent($event);
        $userEvent->setSubscribe($this->subscribe);

//        var_dump($event->getId());
//        var_dump($user->getId());
//        var_dump($this->subscribe);
//        $userEvent->setByEmail($this->byPhone);

        return $userEvent;
    }

}