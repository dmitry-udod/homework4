<?php

namespace Skrepka\CategoryBundle\Document;

use Doctrine\ODM\MongoDB\DocumentRepository;

class CategoryRepository extends DocumentRepository
{
    /**
     * Get all categories query
     *
     * @return \Doctrine\MongoDB\Query\Query
     */
    public function all()
    {
        $q = $this->getDocumentManager()
            ->createQueryBuilder('CategoryBundle:Category')
            ->sort('name')
        ;

        return $q->getQuery();
    }

    /**
     * Find category by slug
     *
     * @param $slug
     * @return \Skrepka\CategoryBundle\Document\Category
     */
    public function findBySlug($slug)
    {
        return $this->findOneBy(['slug' => $slug]);
    }
}