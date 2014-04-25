<?php

namespace Skrepka\CompanyBundle\Document\Statistic;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Skrepka\CompanyBundle\Document\Company;

class CompanyViewRepository extends DocumentRepository
{
    /**
     * Check is user with session already view this company
     *
     * @param Company $company
     * @param $sessionId
     * @return bool
     */
    public function isAlreadyViews(Company $company, $sessionId)
    {
        return !is_null($this->findOneBy(['companyId' => $company->getId(), 'sessionId' => $sessionId]));
    }
}