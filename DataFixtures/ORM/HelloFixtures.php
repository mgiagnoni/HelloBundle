<?php
namespace FooApps\HelloBundle\Fixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use FooApps\HelloBundle\Entity\Friend;

class HelloFixtures implements FixtureInterface
{
    public function load($manager)
    {
        $friend = new Friend();
        $friend->setName('Fabien');
        $manager->persist($friend);

        $friend = new Friend();
        $friend->setName('Felix');
        $manager->persist($friend);

        $manager->flush();
    }
}
