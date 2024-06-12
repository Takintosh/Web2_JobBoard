<?php

class CompanyModel {

    private $id;
    private $name;
    private $logo;
    private $contactEmail;
    private $contactPhone;
    private $website;
    private $description;

    // Getters & Setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLogo()
    {
        return $this->logo;
    }
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    public function getContactEmail()
    {
        return $this->contactEmail;
    }
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;
    }

    public function getContactPhone()
    {
        return $this->contactPhone;
    }
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;
    }

    public function getWebsite()
    {
        return $this->website;
    }
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }



}