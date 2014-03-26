<?php

namespace Skrepka\CompanyBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Skrepka\UserBundle\Document\User;
use Skrepka\CompanyBundle\Document\City;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Company
 *
 * @ODM\Document
 * @ODM\Document(repositoryClass="Skrepka\CompanyBundle\Document\CompanyRepository")
 */
class Company
{
    /**
     * @ODM\Id
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @ODM\String
     */
    protected $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ODM\Field(name="slug")
     */
    protected $slug;

    /**
     * @Assert\NotBlank()
     * @ODM\String
     */
    protected $description;

    /**
     * @var $categories
     *
     * @ODM\ReferenceOne(targetDocument="Skrepka\CategoryBundle\Document\Category")
     */
    protected $category;

    /**
     * @var City
     *
     * @ODM\ReferenceOne(targetDocument="Skrepka\CompanyBundle\Document\City")
     */
    protected $city;

    /**
     * @Assert\NotBlank()
     * @ODM\String
     */
    protected $address;

    /**
     * @ODM\String
     */
    protected $phone;

    /**
     * @ODM\String
     */
    protected $email;

    /**
     * @ODM\String
     */
    protected $site;

    /**
     * @ODM\Boolean
     */
    protected $isActive = false;

    /**
     * @ODM\String
     */
    protected $lat;

    /**
     * @ODM\String
     */
    protected $long;

    /**
     * @ODM\ReferenceOne(targetDocument="Skrepka\CompanyBundle\Document\MetaData")
     */
    protected $metaData;

    /**
     * @var User
     *
     * @Gedmo\Blameable(on="create")
     * @ODM\ReferenceOne(targetDocument="Skrepka\UserBundle\Document\User")
     */
    protected $createdBy;

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

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return id $id
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
     * Set lat
     *
     * @param string $lat
     * @return self
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string $lat
     */
    public function getLat()
    {
        return $this->createdBy;
    }

    /**
     * Set long
     *
     * @param string $long
     * @return self
     */
    public function setLong($long)
    {
        $this->long = $long;

        return $this;
    }

    /**
     * Get long
     *
     * @return string $long
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * Get user which created company
     *
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param \Skrepka\UserBundle\Document\User $createdBy
     */
    public function setCreatedBy(User $createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * Get company slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param \Skrepka\CompanyBundle\Document\City $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return \Skrepka\CompanyBundle\Document\City
     */
    public function getCity()
    {
        return $this->city;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setMetaData($metaData)
    {
        $this->metaData = $metaData;
    }

    public function getMetaData()
    {
        return $this->metaData;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setSite($site)
    {
        $this->site = $site;
    }

    public function getSite()
    {
        return $this->site;
    }

    /**
     * @return \Skrepka\CompanyBundle\Document\datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \Skrepka\CompanyBundle\Document\datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param  $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return
     */
    public function getCategory()
    {
        return $this->category;
    }

//    /**
//     * Set categories
//     *
//     * @param string $categories
//     * @return self
//     */
//    public function setCategories($categories)
//    {
//        $this->categories = $categories;
//
//        return $this;
//    }
//
//    public function addCategory(Category $category)
//    {
//        $this->categories->add($category);
//
//        return $this;
//    }
//
//    /**
//     * Get categories
//     *
//     * @return string $categories
//     */
//    public function getCategories()
//    {
//        return $this->categories;
//    }

}
