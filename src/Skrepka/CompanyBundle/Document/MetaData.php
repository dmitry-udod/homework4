<?php

namespace Skrepka\CompanyBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Company
 *
 * @ODM\Document
 */
class MetaData
{
    /**
     * @ODM\Id
     */
    protected $id;

    /**
     * @var string
     *
     * @ODM\String
     */
    protected $metaKeywords;

    /**
     * @var string
     *
     * @ODM\String
     */
    protected $metaDescription;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set meta description
     *
     * @param $metaDescription
     * @return $this
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get meta data
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set meta keywords
     *
     * @param $metaKeywords
     * @return $this
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get meta keywords
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }
}
