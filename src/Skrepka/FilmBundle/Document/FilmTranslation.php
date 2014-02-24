<?php

namespace Skrepka\FilmBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Document\MappedSuperclass\AbstractPersonalTranslation;

/**
 * Skrepka\FilmBundle\Document\FilmTranslation
 *
 * @ODM\Document
 */
class FilmTranslation extends AbstractPersonalTranslation
{
    /**
     * @var MongoId $id
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;


    protected $object;

//    /**
//     * @ODM\Field(name="title", type="string")
//     */
//    protected $title;
//
//    /**
//     * @return \Skrepka\FilmBundle\Document\MongoId
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    public function setTitle($title)
//    {
//        $this->title = $title;
//    }
//
//    public function getTitle()
//    {
//        return $this->title;
//    }
}