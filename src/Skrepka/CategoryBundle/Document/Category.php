<?php

namespace Skrepka\CategoryBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Skrepka\CategoryBundle\Document\Category
 *
 * @ODM\Document
 * @ODM\Document(repositoryClass="Skrepka\CategoryBundle\Document\CategoryRepository")
 */
class Category
{
    /**
     * @var MongoId $id
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ODM\Field(name="name", type="string")
     */
    protected $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ODM\Field(name="slug")
     */
    protected $slug;

    /**
     * @ODM\ReferenceOne(targetDocument="Skrepka\CategoryBundle\Document\Category")
     */
    protected $parent;

    /**
     * @ODM\ReferenceMany(targetDocument="Skrepka\CategoryBundle\Document\Category")
     */
    protected $children;


    function __toString()
    {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }
}
