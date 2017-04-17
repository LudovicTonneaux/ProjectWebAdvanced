<?php

namespace model;

interface PersonRepository
{
    public function findPersonById($id);
    /*
    public function findPersons();
    public function add(Events $person);
    public function remove($id);
    */
}
