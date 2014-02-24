<?php

namespace Skrepka\FilmBundle\Controller;

use Skrepka\FilmBundle\Event\ViewCounterEvent;
use Skrepka\UserBundle\Document\User;
use Skrepka\UserBundle\Form\UserType;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Skrepka\FilmBundle\Document\Film;
use Skrepka\FilmBundle\Document\FilmTranslation;

class FilmController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
//        $dm = $this->get('doctrine_mongodb')->getManager();
//        $film = $this->get('skrepka.film.repository')->find('52fb73dab80477f3138b456b');
//
//        $article = $dm->find('Entity\Article', 1 /*article id*/);
//        $film->setTitle('my title in ru');
//        $film->setDescription('my content in ru');
//        $film->setTranslatableLocale('ru_ru'); // change locale
//        $dm->persist($film);
//        $dm->flush();

        $films = $this->get('skrepka.film.repository')->findAll();

        return array('films' => $films);
    }

    /**
     * @Template()
     */
    public function viewAction(Film $film)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $event = new ViewCounterEvent($film, $dm);

        $ed = new EventDispatcher();

        $ed->addListener('update_view_counter', function (ViewCounterEvent $event) {
            $event->increaseCounter();
        });
        $ed->dispatch('update_view_counter', $event);

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
