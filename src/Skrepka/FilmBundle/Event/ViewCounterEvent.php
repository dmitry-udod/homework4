<?php

namespace Skrepka\FilmBundle\Event;

use Doctrine\Common\EventArgs;
use Doctrine\ODM\MongoDB\DocumentManager;
use Skrepka\FilmBundle\Document\Film;
use Symfony\Component\EventDispatcher\Event;

class ViewCounterEvent extends Event
{
    protected $film;

    protected $dm;

    public function __construct(Film $film, DocumentManager $dm)
    {
        $this->film = $film;
        $this->dm = $dm;
    }

    public function increaseCounter()
    {
        $counter = $this->film->getViewCounter();
        $this->film->setViewCounter($counter+1);

        $this->dm->flush();
    }
}