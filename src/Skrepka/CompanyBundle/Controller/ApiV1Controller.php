<?php

namespace Skrepka\CompanyBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Skrepka\CompanyBundle\Document\Company;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ApiV1Controller extends Controller
{
    /**
     * Благодоря этому методу можно получить список существующих компаний
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Метод для получения списка компаний",
     *  filters={
     *      {"name"="skip", "dataType"="integer", "description" = "Skip N first companies from companies list"}
     *  },
     * statusCodes={
     *         200="Returned when successful",
     *         500="Returned when there is a server side error"
     *     }
     * )
     * @Rest\View
     * @Rest\Get("/companies/{skip}", requirements={"skip" = "\d+"}, defaults={"skip" = 0})
     */
    public function getCompaniesAction($skip)
    {
        $companies = $this->get('company_manager')->all()
            ->limit(5)
            ->skip($skip)
            ->getQuery();

        return ['companies' => $companies->toArray()];
    }

    /**
     * Благодоря этому методу информацию о компании используя ее текстовы идентификатор (slug)
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Метод для получения информации о конкретной компании",
     *  filters={
     *      {"name"="id", "dataType"="string"},
     *  },
     *  statusCodes={
     *         200="Returned when successful",
     *         404="Returned when the company is not found",
     *         500="Returned when there is a server side error"
     *     }
     * )
     * @Rest\View
     */
    public function getCompanyAction($id)
    {
        $company = $this->get('company_manager')->find($id);

        if (!$company instanceof Company) {
            throw new NotFoundHttpException('Company not found');
        }

        return [$company];
    }
}
