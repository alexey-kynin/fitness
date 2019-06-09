<?php

namespace DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EventBundle\Entity\Event;
use StaffBundle\Entity\Staff;

class EventFixtures implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $staffRepo = $manager->getRepository(Staff::class);
        for ($i = 1; $i <= 5; $i++){
            $event = new Event();
            $event->setTitle('Sporting event '.$i);
            $event->setDescription('Event description '.$i);
//            $trainer = $staffRepo->findOneByName('Trainer '.$i);
            $trainerName = 'Trainer '.$i;
            $trainer = $staffRepo->findOneBy([
                'name' => $trainerName
            ]);
            if ($trainer){
                $event->setStaff($trainer->getId());
            }
            $manager->persist($event);
        }
        $manager->flush();


//        $objects = Fixtures::load(__DIR__ . '/yml_file/EventFixtures.yml', $manager);
    }

    public function getDependecies()
    {
        return [
          Event::class
        ];
    }

    public function getOrder()
    {
        return 4;
    }
}