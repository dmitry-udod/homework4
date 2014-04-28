<?php

namespace Skrepka\CompanyBundle\Document;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Skrepka\CategoryBundle\Document\Category;
use Skrepka\CompanyBundle\Document\Company;
use Skrepka\CompanyBundle\Document\Statistic\CompanyView;

class CompanyRepository extends DocumentRepository
{
    public function all()
    {
        $q = $this->getDocumentManager()
            ->createQueryBuilder('CompanyBundle:Company')
            ->sort('createdAt', 'DESC')
            ->field('isActive')->equals(true)
            ->field('category')->prime(true)
            ->field('logo')->prime(true)
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
     * Increment company views counter
     *
     * @param Company $company
     * @param $sessionId
     * @param $ip
     */
    public function incrementViews(Company $company, $sessionId, $ip)
    {
        $view = new CompanyView();
        $view->setCompanyId($company->getId())
            ->setSessionId($sessionId)
            ->setIp($ip);
        ;
        $this->getDocumentManager()->persist($view);
    }


    /**
     * Find category by category id
     *
     * @param Category $category
     * @return \Doctrine\MongoDB\Query\Builder
     */
    public function findByCategory(Category $category)
    {
        $q = $this->getDocumentManager()
            ->createQueryBuilder('CompanyBundle:Company')
            ->sort('createdAt', 'DESC')
            ->field('category.id')->equals($category->getId())
        ;

        return $q;
    }

    /**
     * Get number of companies for category
     *
     * @param Category $category
     * @return int
     */
    public function countCompaniesForCategory(Category $category)
    {
        return $this->findByCategory($category)->count()->getQuery()->execute();
    }

    /**
     * @param Company $company
     */
    public function save(Company $company)
    {
        $this->getDocumentManager()->persist($company);
    }
}