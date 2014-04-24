<?php

namespace Skrepka\UserBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Skrepka\CompanyBundle\Document\Company;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM\Document
 */
class User extends BaseUser
{
    /**
     * @ODM\Id(strategy="auto")
     */
    protected $id;

    /**
     * @var string
     *
     * @ODM\Field(name="first_name", type="string")
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ODM\Field(name="last_name", type="string")
     */
    protected $lastName;

    /**
     * @var ArrayCollection $companies
     *
     * @ODM\ReferenceMany(targetDocument="Skrepka\CompanyBundle\Document\Company")
     */
    protected $companies;

    public function __construct()
    {
        parent::__construct();

        $this->companies = new ArrayCollection();
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param  ArrayCollection $companies
     */
    public function setCompanies($companies)
    {
        $this->companies = $companies;
    }

    /**
     * Get user companies
     *
     * @return ArrayCollection
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    public function addCompany(Company $company)
    {
        $this->companies->add($company);
    }

    /**
     * Get User company
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->getCompanies()->first();
    }
}