<?php

namespace Skrepka\FilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestController extends Controller
{
    /**
     * @Rest\View
     */
    public function allAction()
    {
        $films = $this->get('skrepka.film.repository')->findAll();

        return array('films' => $films->toArray());
    }

}
