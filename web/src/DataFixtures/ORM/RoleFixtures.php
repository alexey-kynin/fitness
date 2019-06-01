<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 28.05.2019
 * Time: 15:55
 */

namespace DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;
use UserBundle\Entity\Roles;

class RoleFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $roleRepo = $manager->getRepository(Roles::class);
        $role = $roleRepo->findByRole('ROLE_USER');
        if (!$role){
            $objects = Fixtures::load(__DIR__ . '/yml_file/RoleFixtures.yml', $manager);
        }

    }

    public function getOrder()
    {
        return 1;
    }
}