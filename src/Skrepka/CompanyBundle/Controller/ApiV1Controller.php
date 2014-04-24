<?php

namespace Skrepka\CompanyBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ApiV1Controller extends Controller
{
    /**
     * Благодоря этому методу вы можете получить список существующих компаний
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Метод для получения списка компаний",
     *  filters={
     *      {"name"="a-filter", "dataType"="integer"},
     *      {"name"="another-filter", "dataType"="string", "pattern"="(foo|bar) ASC|DESC"}
     *  },
     * statusCodes={
     *         200="Returned when successful",
     *         403="Returned when the user is not authorized to say hello",
     *         404={
     *           "Returned when the user is not found",
     *           "Returned when something else is not found"
     *         },
     *         500="Returned when there is a server side error"
     *     }
     * )
     * @Rest\View
     */
    public function getCompaniesAction()
    {
        $films = $this->get('skrepka.film.repository')->findAll();

        return array('films' => $films->toArray());
    }

    /**
     * Благодоря этому методу информацию о компании используя ее текстовы идентификатор (slug)
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Метод для получения информации о конкретной компании",
     *  filters={
     *      {"name"="slug", "dataType"="string"},
     *  }
     * )
     * @Rest\View
     */
    public function getCompanyAction($slug)
    {
        $films = $this->get('skrepka.film.repository')->findAll();

        return array('films' => $films->toArray());
    }

}
