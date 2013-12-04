<?php

namespace Skrepka\CategoryBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Skrepka\CategoryBundle\Document\Category;

class LoadCategoryData implements FixtureInterface, OrderedFixtureInterface
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
        $category = new Category();
        $category->setName('Dramma');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Melodramma');
        $manager->persist($category);

        $manager->flush();
    }
}