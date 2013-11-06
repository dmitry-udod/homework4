<?php

namespace Skrepka\FilmBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FilmController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        $films = $this->get('skrepka.film.repository')->findAll();

        return array('films' => $films);
    }
}
