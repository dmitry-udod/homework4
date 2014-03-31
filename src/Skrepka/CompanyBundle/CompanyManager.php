<?php

namespace Skrepka\CompanyBundle;

use Skrepka\CompanyBundle\Document\Company;
use Skrepka\CompanyBundle\Document\CompanyRepository;

class CompanyManager
{
    protected $companyRepo;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepo = $companyRepo;
    }

    public function all()
    {
        return $this->companyRepo->findAll();
    }

    /**
     * @param $slug
     * @return Company
     */
    public function findBySlug($slug)
    {
        return $this->companyRepo->findBySlug($slug);
    }

    /**
     * @param $id
     * @return Company
     */
    public function find($id)
    {
        return $this->companyRepo->find($id);
    }
}