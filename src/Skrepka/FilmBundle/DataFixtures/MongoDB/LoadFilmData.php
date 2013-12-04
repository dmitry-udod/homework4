<?php

namespace Skrepka\FilmBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Skrepka\FilmBundle\Document\Film;

class LoadFilmData implements FixtureInterface, OrderedFixtureInterface
{
    public function getOrder()
    {
        return 2;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $categories = $manager->getRepository('CategoryBundle:Category')->findAll()->toArray();
        $actors = $manager->getRepository('ActorBundle:Actor')->findAll()->toArray();

        $film = new Film();
        $film->setActors($actors)
            ->setCategories($categories)
            ->setDescription('Test Film')
            ->setTitle('Test')
            ->setGenres('Adult')
            ->setYear('1980')
        ;
        $manager->persist($film);

        $film = new Film();
        $film->setActors($actors)
            ->setCategories($categories)
            ->setDescription('Test Film2')
            ->setTitle('Test2')
            ->setGenres('Adult2')
            ->setYear('1981')
        ;
        $manager->persist($film);

        $manager->flush();
    }
}