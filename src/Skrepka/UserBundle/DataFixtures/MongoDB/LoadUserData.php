<?php

namespace Skrepka\UserBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Skrepka\UserBundle\Document\User;

class LoadUserData implements FixtureInterface, OrderedFixtureInterface
{
    public function getOrder()
    {
        return 1;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setEmailCanonical('admin@admin.com');
        $user->setEnabled(true);
        $user->setPlainPassword('admin');
        $user->setSuperAdmin(true);
        $user->setUsername('admin');
        $user->setUsernameCanonical('admin');
        $user->addRole('ROLE_ADMIN');
        $manager->persist($user);

        $manager->flush();
    }
}