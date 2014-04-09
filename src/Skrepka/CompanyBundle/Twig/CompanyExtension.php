<?php

namespace Skrepka\CompanyBundle\Twig;

use Doctrine\Common\Collections\ArrayCollection;
use Skrepka\UserBundle\Document\User;

class CompanyExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('is_user_has_company', [$this, 'isUserHasCompany']),
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

    public function getName()
    {
        return 'company_extension';
    }
}