<?php

class ApplicationModel {

    private $jobOpeningId;
    private $userId;
    private $status;
    private $applicationDate;

    private $user;
    private $jobOpening;

    public function getJobOpeningId()
    {
        return $this->jobOpeningId;
    }
    public function setJobOpeningId($jobOpeningId)
    {
        $this->jobOpeningId = $jobOpeningId;
    }

    public function getUserId()
    {
        return $this->userId;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getApplicationDate()
    {
        return $this->applicationDate;
    }
    public function setApplicationDate($applicationDate)
    {
        $this->applicationDate = $applicationDate;
    }

    public function getUser()
    {
        return $this->user;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getJobOpening()
    {
        return $this->jobOpening;
    }
    public function setJobOpening($jobOpening)
    {
        $this->jobOpening = $jobOpening;
    }

}