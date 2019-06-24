<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 30.05.2019
 * Time: 21:36
 */

namespace EventBundle\Form\Models;


class MessageModel
{
    public $message_text;

    /**
     * @return mixed
     */
    public function getMessageText()
    {
        return $this->message_text;
    }

    /**
     * @param mixed $message_text
     */
    public function setMessageText($message_text)
    {
        $this->message_text = $message_text;
    }


}