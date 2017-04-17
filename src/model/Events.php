<?php

namespace model;

class Events
{
    private $id;
    private $personId;
    private $date;

    public function __construct($id, $personId, $date)
    {
        $this->id = $id;
        $this->personId = $personId;
        $this->date = $date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPersonId()
    {
        return $this->id;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }
}
