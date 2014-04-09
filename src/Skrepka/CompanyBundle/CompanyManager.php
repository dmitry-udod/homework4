<?php

namespace Skrepka\CompanyBundle;

use FOS\UserBundle\Doctrine\UserManager;
use Skrepka\CompanyBundle\Document\Company;
use Skrepka\CompanyBundle\Document\CompanyRepository;
use Skrepka\UserBundle\Document\User;
use Symfony\Component\Security\Core\SecurityContext;

class CompanyManager
{
    protected $companyRepo;

    /**
     * @var SecurityContext
     */
    protected $context;

    /**
     * @var UserManager
     */
    protected $userManager;

    public function __construct(CompanyRepository $companyRepo, SecurityContext $context, $userManager)
    {
        $this->companyRepo = $companyRepo;
        $this->context = $context;
        $this->userManager = $userManager;
    }

    /**
     * Get all companies
     *
     * @return array
     */
    public function all()
    {
        return $this->companyRepo->findAll();
    }

    /**
     * Find company by slug
     *
     * @param $slug
     * @return Company
     */
    public function findBySlug($slug)
    {
        return $this->companyRepo->findBySlug($slug);
    }

    /**
     * Find company by id
     *
     * @param $id
     * @return Company
     */
    public function find($id)
    {
        return $this->companyRepo->find($id);
    }

    /**
     * Save company and attach this company to owner
     *
     * @param Company $company
     */
    public function save(Company $company)
    {
        $this->companyRepo->save($company);

        /** @var User $user  */
        $user = $this->context->getToken()->getUser();
        $user->addCompany($company);
        $this->userManager->updateUser($user, false);
    }

    public function delete($id)
    {
        $company = $this->find($id);

        $user = $this->context->getToken()->getUser();
        $user->getCompanies()->removeElement($company);

        $this->companyRepo->getDocumentManager()->remove($company);
    }
}