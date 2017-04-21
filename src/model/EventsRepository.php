<?php

namespace model;

interface EventsRepository
{
    public function findEventById($id);
    /*
    public function findPersons();
    public function add(Events $person);
    public function remove($id);
    */
}
