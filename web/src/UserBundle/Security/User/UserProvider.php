<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 01.06.2019
 * Time: 12:57
 */

namespace UserBundle\Security\User;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use UserBundle\Entity\User;


class UserProvider implements UserProviderInterface
{

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct( EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function loadUserByUsername($email)
    {
        $user = $this->findOneUserBy(['email' => $email]);

        if (!$user) {
            throw new UsernameNotFoundException(
                sprintf(
                    'User UP with "%s" email does not exist.',
                    $email
                )
            );
        }

        return $user;
    }

    private function findOneUserBy(array $options)
    {
        return $this->em
            ->getRepository(User::class)
            ->findOneBy($options);
    }

    public function refreshUser(UserInterface $user)
    {
        assert($user instanceof User);

        if (null === $reloadedUser = $this->findOneUserBy(['id' => $user->getId()])) {
            throw new UsernameNotFoundException(sprintf(
                'User with ID "%s" could not be reloaded.',
                $user->getId()
            ));
        }

        return $reloadedUser;
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }

//////////////////////////////////////////////////////////////////
//    private $em;
//
//    public function __construct( EntityManager $entity_manager ) {
//        $this->em = $entity_manager;
//    }
//
//    public function loadUserByUsername($username) {
//        $user = $this->em->getRepository('UserBundle:User')->loadUserByUsername($username);
//        if($user)
//            return $user;
//
//        throw new UsernameNotFoundException(
//            sprintf('Username "%s" does not exist.', $username)
//        );
//    }
//
//    public function refreshUser(UserInterface $user) {
//        return $this->loadUserByUsername($user->getUsername());
//    }
//
//    public function supportsClass($class) {
//        return User::class === $class;
//    }



}