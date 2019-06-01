<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 01.06.2019
 * Time: 12:57
 */

namespace UserBundle\Security\User;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use UserBundle\Entity\User;

class UserProvider implements UserProviderInterface
{

    private $em;

    public function __construct( EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function loadUserByUsername($username)
    {
        // Кынин. Загружаем пользователя
        $user = $this->em->getRepository('UserBundle:User')->loadUserByUsername($username);
        if($user){
            return $user;
        }else{
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exit.', $username)
            );
        }
    }

    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}