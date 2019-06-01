<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 30.05.2019
 * Time: 21:36
 */

namespace UserBundle\Form\Models;


class RecoverUserModel
{
    public $email;

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
}