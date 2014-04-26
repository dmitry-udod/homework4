<?php

namespace Skrepka\CategoryBundle\Document;

use Doctrine\ODM\MongoDB\DocumentRepository;

class CategoryRepository extends DocumentRepository
{
    public function all()
    {
        $q = $this->getDocumentManager()
            ->createQueryBuilder('CategoryBundle:Category')
            ->sort('name')
        ;

        return $q->getQuery();
    }
}