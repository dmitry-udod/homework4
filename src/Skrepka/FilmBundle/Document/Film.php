<?php

namespace Skrepka\FilmBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Skrepka\ActorBundle\Document\Actor;
use Skrepka\CategoryBundle\Document\Category;

/**
 * Skrepka\FilmBundle\Document\Film
 *
 * @ODM\Document
 * @ODM\Document(repositoryClass="Skrepka\FilmBundle\Document\FilmRepository")
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class Film
{
    /**
     * @var MongoId $id
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $title
     *
     * @ODM\Field(name="title", type="string")
     */
    protected $title;

    /**
     * @var string $year
     *
     * @ODM\Field(name="year", type="string")
     */
    protected $year;

    /**
     * @var string $description
     *
     * @ODM\Field(name="description", type="string")
     */
    protected $description;

    /**
     * @var string $actors
     *
     * @ODM\ReferenceMany(targetDocument="Skrepka\ActorBundle\Document\Actor")
     */
    protected $actors;

    /**
     * @var string $categories
     *
     * @ODM\ReferenceMany(targetDocument="Skrepka\CategoryBundle\Document\Category")
     */
    protected $categories;

    /**
     * @var string $genres
     *
     * @ODM\Field(name="genres", type="string")
     */
    protected $genres;

    function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set year
     *
     * @param string $year
     * @return self
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * Get year
     *
     * @return string $year
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set actors
     *
     * @param string $actors
     * @return self
     */
    public function setActors($actors)
    {
        $this->actors = $actors;
        return $this;
    }

    /**
     * Get actors
     *
     * @return string $actors
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * Set categories
     *
     * @param string $categories
     * @return self
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * Get categories
     *
     * @return string $categories
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set genres
     *
     * @param string $genres
     * @return self
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;
        return $this;
    }

    /**
     * Get genres
     *
     * @return string $genres
     */
    public function getGenres()
    {
        return $this->genres;
    }
}
