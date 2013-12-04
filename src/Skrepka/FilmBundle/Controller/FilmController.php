<?php

namespace Skrepka\FilmBundle\Controller;

use Skrepka\UserBundle\Document\User;
use Skrepka\UserBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Skrepka\FilmBundle\Document\Film;

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

    /**
     * @Template()
     */
    public function viewAction(Film $film)
    {
        return array('film' => $film);
    }

    /**
     * @Template()
     */
    public function payAction(Film $film)
    {
        $form = $this->createForm(new UserType(), new User());
        $request = $this->getRequest();

        if ('POST' === $request->getRealMethod()) {
            $form->handleRequest($request);

            if ($form->isValid()) {

            }
        }

        return array(
            'form' => $form->createView(),
            'film' => $film,
        );
    }
}
