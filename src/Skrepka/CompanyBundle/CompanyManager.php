<?php

namespace Skrepka\CompanyBundle;

use FOS\UserBundle\Doctrine\UserManager;
use Skrepka\CompanyBundle\Document\Company;
use Skrepka\CompanyBundle\Document\CompanyRepository;
use Skrepka\CompanyBundle\Document\File\MediaRepository;
use Skrepka\UserBundle\Document\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Session\Session;

class CompanyManager
{
    /** @var CompanyRepository */
    protected $companyRepo;

    /**@var SecurityContext */
    protected $context;

    /** @var UserManager */
    protected $userManager;

    /** @var MediaRepository */
    protected $mediaRepo;

    /** @var Session */
    protected $session;

    public function __construct(
        CompanyRepository $companyRepo,
        SecurityContext $context,
        $userManager,
        MediaRepository $mediaRepo,
        Session $session
    )
    {
        $this->companyRepo = $companyRepo;
        $this->context = $context;
        $this->userManager = $userManager;
        $this->mediaRepo = $mediaRepo;
        $this->session = $session;
    }

    /**
     * Get all companies
     *
     * @return array
     */
    public function all()
    {
        return $this->companyRepo->all();
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
        if ($this->isCurrentUserCanCreateOneMoreCompany()) {
            if (is_null($company->getId())) {
                $this->companyRepo->save($company);

                /** @var User $user  */
                $user = $this->context->getToken()->getUser();
                $user->addCompany($company);
                $this->userManager->updateUser($user, false);
            }

            // Process company logo
            $file = $company->getLogo();

            if($file instanceof UploadedFile) {
                $media = $this->mediaRepo->upload($file);
                $company->setLogo($media);
            }
        }
    }

    public function delete($id)
    {
        $company = $this->find($id);

        if ($company instanceof Company) {
            $user = $this->getUser();
            $user->getCompanies()->removeElement($company);

            $this->companyRepo->getDocumentManager()->remove($company);
        }
    }

    /**
     * Check is current user can create one mor company
     *
     * @return bool
     */
    public function isCurrentUserCanCreateOneMoreCompany()
    {
        $result = false;
        $user = $this->getUser();

        $companies = $user->getCompanies();

        if ($companies->count() < 1 || $user->isSuperAdmin()) {
            $result =  true;
        }

        return $result;
    }

    /**
     * Check is current user company owner
     *
     * @param Company $company
     * @return bool
     */
    public function isOwner(Company $company)
    {
        $companies = $this->getUser()->getCompanies();

        return $companies->contains($company);
    }

    public function increaseViews()
    {
        var_dump($this->session->getId());
//        $this->session->
    }

    /**
     * Get current user
     *
     * @return User
     */
    private function getUser()
    {
        return $this->context->getToken()->getUser();
    }
}