<?php

namespace Skrepka\FilmBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;
use Skrepka\ActorBundle\Document\Actor;
use Skrepka\CategoryBundle\Document\Category;
use Skrepka\FilmBundle\Document\FilmTranslation;
use Gedmo\Translatable\Translatable;

/**
 * Skrepka\FilmBundle\Document\Film
 *
 * @ODM\Document
 * @ODM\Document(repositoryClass="Skrepka\FilmBundle\Document\FilmRepository")
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class Film implements Translatable
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
     * @Gedmo\Translatable
     * @ODM\Field(name="title", type="string")
     */
    protected $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ODM\Field(name="slug")
     */
    private $slug;

    /**
     * @var string $year
     *
     * @ODM\Field(name="year", type="string")
     */
    protected $year;

    /**
     * @var string $description
     *
     * @Gedmo\Translatable
     * @ODM\Field(name="description", type="string")
     */
    protected $description;

    /**
     * @var $actors
     *
     * @ODM\ReferenceMany(targetDocument="Skrepka\ActorBundle\Document\Actor")
     */
    protected $actors;

    /**
     * @var $categories
     *
     * @ODM\ReferenceMany(targetDocument="Skrepka\CategoryBundle\Document\Category")
     */
    protected $categories;

//    /**
//     * @var $translations
//     *
//     * @ODM\ReferenceMany(targetDocument="Skrepka\FilmBundle\Document\FilmTranslation")
//     */
//    protected $translations;

    /**
     * @var string $genres
     *
     * @ODM\Field(name="genres", type="string")
     */
    protected $genres;

    /**
     * @var integer $viewCounter
     *
     * @ODM\Field(name="view_counter", type="int")
     */
    protected $viewCounter = 0;

    /**
     * @var datetime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ODM\Field(name="created_at",type="date")
     */
    protected $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ODM\Field(name="updated_at", type="date")
     */
    protected $updatedAt;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->translations = new ArrayCollection();
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
     * @param $title
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
     * @param ArrayCollection $actors
     * @return self
     */
    public function setActors($actors)
    {
        $this->actors = $actors;

        return $this;
    }

    /**
     * Add actor
     *
     * @param Actor $actor
     */
    public function addActor(Actor $actor)
    {
        $this->actors->add($actor);

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

    public function addCategory(Category $category)
    {
        $this->categories->add($category);

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

    /**
     * @param int $viewCounter
     */
    public function setViewCounter($viewCounter)
    {
        $this->viewCounter = $viewCounter;
    }

    /**
     * @return int
     */
    public function getViewCounter()
    {
        return $this->viewCounter;
    }

    /**
     * @return \Skrepka\FilmBundle\Document\datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \Skrepka\FilmBundle\Document\datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
//
//    public function setLocale($locale)
//    {
//        $this->locale = $locale;
//    }
//
//    public function getLocale()
//    {
//        return $this->locale;
//    }
//
//    /**
//     * Set $translations
//     *
//     * @param string $translations
//     * @return self
//     */
//    public function setTranslations($translations)
//    {
////        var_dump($translations);die('$translations');
//        $this->translations = $translations;
//
//        return $this;
//    }
//
//    public function addTranslation(FilmTranslation $translation)
//    {
////        die(var_dump($translation));
//        $this->translations->add($translation);
//
//        $this->setTranslations($this->translations);
//
//        return $this;
//    }
//
//    public function removeTranslation(FilmTranslation $translation)
//    {
//        $this->translations->removeElement($translation);
//
//        return $this;
//    }
//
//    /**
//     * Get translations
//     *
//     * @return string $translations
//     */
//    public function getTranslations()
//    {
////var_dump($this->translations);
//        return $this->translations;
//    }
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}