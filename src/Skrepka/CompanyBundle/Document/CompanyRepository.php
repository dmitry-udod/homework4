<?php

namespace Skrepka\CompanyBundle\Document;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Skrepka\CompanyBundle\Document\Company;

class CompanyRepository extends DocumentRepository
{
    public function all()
    {
        $q = $this->getDocumentManager()
            ->createQueryBuilder('CompanyBundle:Company')
            ->sort('createdAt', 'DESC')
            ->field('category')->prime(true)
        ;

        return $q;
    }

    /**
     * Find company by id
     *
     * @param object|string $id
     * @return Company
     */
    public function find($id)
    {
        return $this->findOneBy(['id' => $id ]);
    }

    /**
     * Find company by slug
     *
     * @param $slug
     * @return Company
     */
    public function findBySlug($slug)
    {
        return $this->findOneBy(['slug' => $slug]);
    }

    /**
     * @param Company $company
     */
    public function save(Company $company)
    {
        $this->getDocumentManager()->persist($company);
    }
}