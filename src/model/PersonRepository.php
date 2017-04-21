<?php

namespace model;

interface PersonRepository
{
    public function findPersonById($id);
    /*
    public function findEvents();
    public function add(Events $event);
    public function remove($id);
    */
}
