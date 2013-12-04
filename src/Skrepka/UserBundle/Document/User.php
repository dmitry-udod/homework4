<?php

namespace Skrepka\UserBundle\Document;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @MongoDB\Field(name="first_name", type="string")
     */
    protected $firstName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @MongoDB\Field(name="last_name", type="string")
     */
    protected $lastName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @MongoDB\Field(name="credit_card", type="string")
     */
    protected $creditCard;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $creditCard
     */
    public function setCreditCard($creditCard)
    {
        $this->creditCard = $creditCard;
    }

    /**
     * @return string
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }
}