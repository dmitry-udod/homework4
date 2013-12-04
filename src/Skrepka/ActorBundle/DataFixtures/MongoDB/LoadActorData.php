<?php

namespace Skrepka\ActorBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Skrepka\ActorBundle\Document\Actor;

class LoadActorData implements FixtureInterface, OrderedFixtureInterface
{
    public function  getOrder()
    {
        return 1;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $actor = new Actor();
        $actor->setFirstName('John');
        $actor->setLastName('Doe');
        $actor->setBirthday(new \MongoDate());

        $manager->persist($actor);

        $manager->flush();
    }
}