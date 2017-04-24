<?php
namespace CloneBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;

/**
 * @MongoDB\Document(collection="Feeds")
 */
class Feed
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $main_category;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $sub_category;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $details;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $location;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;


    /**
     * @MongoDB\Field(type="string")
     */
    protected $contact;



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
     * Set mainCategory
     *
     * @param string $mainCategory
     * @return $this
     */
    public function setMainCategory($mainCategory)
    {
        $this->main_category = $mainCategory;
        return $this;
    }

    /**
     * Get mainCategory
     *
     * @return string $mainCategory
     */
    public function getMainCategory()
    {
        return $this->main_category;
    }

    /**
     * Set subCategory
     *
     * @param string $subCategory
     * @return $this
     */
    public function setSubCategory($subCategory)
    {
        $this->sub_category = $subCategory;
        return $this;
    }

    /**
     * Get subCategory
     *
     * @return string $subCategory
     */
    public function getSubCategory()
    {
        return $this->sub_category;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set details
     *
     * @param string $details
     * @return $this
     */
    public function setDetails($details)
    {
        $this->details = $details;
        return $this;
    }

    /**
     * Get details
     *
     * @return string $details
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return $this
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Get location
     *
     * @return string $location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return $this
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
     * Set contact
     *
     * @param string $contact
     * @return $this
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * Get contact
     *
     * @return string $contact
     */
    public function getContact()
    {
        return $this->contact;
    }
}
