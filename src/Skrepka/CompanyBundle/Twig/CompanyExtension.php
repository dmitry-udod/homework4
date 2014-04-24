<?php

namespace Skrepka\CompanyBundle\Twig;

use Skrepka\CompanyBundle\Document\Company;
use Skrepka\UserBundle\Document\User;

class CompanyExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('is_user_has_company', [$this, 'isUserHasCompany']),
            new \Twig_SimpleFunction('is_company_owner', [$this, 'isUserCompanyOwner']),
        );
    }

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

    public function getName()
    {
        return 'company_extension';
    }
}