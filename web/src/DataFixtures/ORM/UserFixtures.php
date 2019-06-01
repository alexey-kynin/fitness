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

class UserFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $roleRepo = $manager->getRepository(Roles::class);
        $role = $roleRepo->findOneByRole('ROLE_USER');
        if (!role){
            return;
        }

        $objects = Fixtures::load(__DIR__ . '/yml_file/UserFixtures.yml', $manager);
    }

    public function getOrder()
    {
        return 2;
    }
}