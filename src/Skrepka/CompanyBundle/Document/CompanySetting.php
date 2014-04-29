<?php

namespace Skrepka\CompanyBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Company
 *
 * @ODM\Document
 */
class CompanySetting
{
    /**
     * @ODM\Id
     */
    protected $id;

    /**
     * @var string Background color
     *
     * @ODM\String
     */
    protected $bgColor = 'white';

    /**
     * Set company background color
     *
     * @param string $bgColor
     */
    public function setBgColor($bgColor)
    {
        $this->bgColor = $bgColor;
    }

    /**
     * Get company background color
     *
     * @return string
     */
    public function getBgColor()
    {
        return $this->bgColor;
    }

    public function getId()
    {
        return $this->id;
    }
}
