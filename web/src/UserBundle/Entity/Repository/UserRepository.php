<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 29.05.2019
 * Time: 16:50
 */

namespace UserBundle\Entity\Repository;


use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends EntityRepository implements UserLoaderInterface
{

    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)->setParameter('email', $username)
            ->getQuery()->getOneOrNullResult();

    }
}