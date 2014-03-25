<?php

namespace Skrepka\FilmBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Skrepka\CompanyBundle\Document\City;

class LoadCityData implements FixtureInterface, OrderedFixtureInterface
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
        $city = new City();

        $city->setName('Черкассы');

        $manager->persist($city);

        $manager->flush();
    }
}