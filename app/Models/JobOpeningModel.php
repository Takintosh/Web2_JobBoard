<?php

class JobOpeningModel {
    private $id;
    private $title;
    private $description;
    private $company_id;
    private $location;
    private $contract;
    private $experience;
    private $level;
    private $status;
    private $publication_date;
    private $publisher_id;
    private $salary;
    private $company;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCompanyId()
    {
        return $this->company_id;
    }
    public function setCompanyId($company_id)
    {
        $this->company_id = $company_id;
    }

    public function getLocation()
    {
        return $this->location;
    }
    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getContract()
    {
        return $this->contract;
    }
    public function setContract($contract)
    {
        $this->contract = $contract;
    }

    public function getExperience()
    {
        return $this->experience;
    }
    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    public function getLevel()
    {
        return $this->level;
    }
    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getPublicationDate()
    {
        return $this->publication_date;
    }
    public function setPublicationDate($publication_date)
    {
        $this->publication_date = $publication_date;
    }

    public function getPublisherId()
    {
        return $this->publisher_id;
    }
    public function setPublisherId($publisher_id)
    {
        $this->publisher_id = $publisher_id;
    }

    public function getSalary()
    {
        return $this->salary;
    }
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public function getCompany()
    {
        return $this->company;
    }
    public function setCompany($company)
    {
        $this->company = $company;
    }

}