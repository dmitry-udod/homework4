<?php

namespace Skrepka\CompanyBundle\Document\File;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ODM\Document
 * @ODM\Document(repositoryClass="Skrepka\CompanyBundle\Document\File\MediaRepository")
 */
class Media
{
    /**
     * @ODM\Id
     */
    protected  $id;

    /**
     * Original file name
     *
     * @ODM\String
     */
    protected $name;

    /**
     * File reference
     *
     * @ODM\String
     */
    protected $reference;

    /**
     * Directory where file stored
     *
     * @ODM\String
     */
    protected $path = 'media';

    /**
     * File mime type
     *
     * @ODM\String
     */
    protected $mimeType;

    /**
     * File size in bytes
     *
     * @ODM\Int
     */
    protected $size;

    /**
     * @var datetime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ODM\Field(name="created_at",type="date")
     */
    protected $createdAt;

    /**
     * Get file name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set file name
     *
     * @param string $name
     * @return Media
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get file mime type
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set file mime type
     *
     * @param  string $mimeType
     * @return Media
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Set file size
     *
     * @param $size
     * @return Media
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get file size
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get upload dir
     *
     * @return string
     */
    public function  getUploadDir()
    {
        return 'uploads/' . $this->path;
    }

    /**
     * Get absolute upload dir path
     *
     * @return string
     */
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
    }

    /**
     * Get created at date
     *
     * @return \MongoDate
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get media id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set upload path dir
     *
     * @param string $path
     * @return Media
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get upload path dir
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set file reference
     *
     * @param string $reference
     * @return Media
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get file reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }
}