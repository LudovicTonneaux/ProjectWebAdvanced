<?php

namespace model;

class Person
{
    private $id;
    private $eventsId;
    private $name;

    public function __construct($id, $eventsId, $name)
    {
        $this->id = $id;
        $this->eventsId = $eventsId;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEventsId()
    {
        return $this->eventsId;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
