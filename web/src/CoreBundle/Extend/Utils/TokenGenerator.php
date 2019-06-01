<?php

namespace CoreBundle\Extend\Utils;


class TokenGenerator
{
    public static function generateToken()
    {
        return rtrim(strtr(base64_encode(self::getRandomNumber()), '+/', '-_'), '=');
    }

    public static function getRandomNumber(){
        return hash('sha256', uniqid(mt_rand(), true), true);
    }
}