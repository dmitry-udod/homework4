<?php

namespace Skrepka\GestBookBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Skrepka\GestBookBundle\Document\Post
 *
 * @ODM\Document(
 *     repositoryClass="Skrepka\GestBookBundle\Document\PostRepository"
 * )
 *
 */
//@ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
class Post
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
     * @var string $email
     *
     * @ODM\Field(name="email", type="string")
     */
    protected $email;

    /**
     * @var string $description
     *
     * @ODM\Field(name="description", type="string")
     */
    protected $description;

    /**
     * @var timestamp $created_at
     *
     * @ODM\Field(name="created_at", type="date")
     */
    protected $created_at;

    function __construct()
    {
        $this->created_at = new \MongoDate();
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

    /**
     * Set email
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
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
     * Set createdAt
     *
     * @param timestamp $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return timestamp $createdAt
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
}
