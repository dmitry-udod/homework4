<?php

namespace Skrepka\CompanyBundle\Twig;

use Skrepka\CompanyBundle\Document\Company;
use Skrepka\CompanyBundle\Document\CompanyRepository;
use Skrepka\UserBundle\Document\User;

class CompanyExtension extends \Twig_Extension
{
    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepo = $companyRepo;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('is_user_has_company', [$this, 'isUserHasCompany']),
            new \Twig_SimpleFunction('is_company_owner', [$this, 'isUserCompanyOwner']),
            new \Twig_SimpleFunction('category_company_count', [$this, 'categoryCompanyCount']),
        );
    }

    /**
     * Check is user has company
     *
     * @param User $user
     * @return bool
     */
    public function isUserHasCompany($user)
    {
        $result = false;

        if ($user instanceof User) {
            $companies = $user->getCompanies();

            if ($companies->count() > 0 && !$user->isSuperAdmin()) {
                $result =  true;
            }
        }
        return $result;
    }

    /**
     * Is current user company owner
     *
     * @param User $user
     * @param Company $company
     * @return bool
     */
    public function isUserCompanyOwner($user, $company)
    {
        $result = false;

        if ($user instanceof User && $company instanceof Company) {
            $companies = $user->getCompanies();
            $result = ($companies->contains($company) || $user->isSuperAdmin()) ? true : false;
        }

        return $result;
    }

    /**
     * @param $category
     * @return \Doctrine\MongoDB\Query\Builder
     */
    public function categoryCompanyCount($category)
    {
        return $this->companyRepo->countCompaniesForCategory($category);
    }

    /**
     * Get extension name (service)
     *
     * @return string
     */
    public function getName()
    {
        return 'company_extension';
    }
}