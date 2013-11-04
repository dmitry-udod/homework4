<?php

namespace Skrepka\ActorBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Skrepka\ActorBundle\Document\Actor
 *
 * @ODM\Document
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class Actor
{
    /**
     * @var MongoId $id
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $first_name
     *
     * @ODM\Field(name="first_name", type="string")
     */
    protected $firstName;

    /**
     * @var string $last_name
     *
     * @ODM\Field(name="last_name", type="string")
     */
    protected $lastName;

    /**
     * @var date $birthday
     *
     * @ODM\Field(name="birthday", type="date")
     */
    protected $birthday;

    function __toString()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
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
     * Set firstName
     *
     * @param string $firstName
     * @return self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set birthday
     *
     * @param date $birthday
     * @return self
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return date $birthday
     */
    public function getBirthday()
    {
        return $this->birthday;
    }
}