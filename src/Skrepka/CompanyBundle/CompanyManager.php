<?php

namespace Skrepka\CompanyBundle;

use FOS\UserBundle\Doctrine\UserManager;
use Skrepka\CompanyBundle\Document\Company;
use Skrepka\CompanyBundle\Document\CompanyRepository;
use Skrepka\CompanyBundle\Document\File\MediaRepository;
use Skrepka\UserBundle\Document\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\SecurityContext;

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

    public function __construct(CompanyRepository $companyRepo, SecurityContext $context, $userManager, MediaRepository $mediaRepo)
    {
        $this->companyRepo = $companyRepo;
        $this->context = $context;
        $this->userManager = $userManager;
        $this->mediaRepo = $mediaRepo;
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

        // Process company logo
        $file = $company->getLogo();

        if($file instanceof UploadedFile) {
            $media = $this->mediaRepo->upload($file);
            $company->setLogo($media);
        }
    }

    public function delete($id)
    {
        $company = $this->find($id);

        $user = $this->context->getToken()->getUser();
        $user->getCompanies()->removeElement($company);

        $this->companyRepo->getDocumentManager()->remove($company);
    }
}