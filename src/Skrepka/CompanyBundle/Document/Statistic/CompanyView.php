<?php

namespace Skrepka\CompanyBundle\Document\Statistic;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Company Views Statistic
 *
 * @ODM\Document(repositoryClass="Skrepka\CompanyBundle\Document\Statistic\CompanyViewRepository")
 */
class CompanyView
{
    /**
     * @ODM\Id
     */
    protected $id;

    /**
     * @var string Session id
     *
     * @ODM\String
     * @ODM\UniqueIndex
     */
    protected $sessionId;

    /**
     * @var string Company id
     *
     * @ODM\String
     * @ODM\Index
     */
    protected $companyId;

    /**
     * @var string viewer ip
     *
     * @ODM\String
     */
    protected $ip;

    /**
     * @var \DateTime Created at
     *
     * @ODM\Field(name="created_at",type="date")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;


    public function getId()
    {
        return $this->id;
    }

    /**
     * Set viewed company id
     *
     * @param $companyId
     * @return CompanyView
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get viewed company id
     *
     * @return string
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set session id which view company
     *
     * @param $sessionId
     * @return CompanyView
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * Get session id
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Get created at time
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     *  Set ip
     *
     * @param string $ip
     * @return CompanyView
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get viewer ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }
}
