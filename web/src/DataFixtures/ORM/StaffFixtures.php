<?php

namespace DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class StaffFixtures implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $objects = Fixtures::load(__DIR__ . '/yml_file/StaffFixtures.yml', $manager);
    }

    public function getOrder()
    {
        return 3;
    }
}