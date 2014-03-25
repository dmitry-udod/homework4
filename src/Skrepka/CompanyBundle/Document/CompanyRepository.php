<?php

namespace Skrepka\CompanyBundle\Document;

use Doctrine\ODM\MongoDB\DocumentRepository;

class CompanyRepository extends DocumentRepository
{
    public function findBySlug($slug)
    {
        return $this->findOneBy(['slug' => $slug]);
    }
}