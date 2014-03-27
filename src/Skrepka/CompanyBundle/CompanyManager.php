<?php

namespace Skrepka\CompanyBundle;

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
}