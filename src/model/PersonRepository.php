<?php

namespace model;

interface EventsRepository
{
    public function findEventById($id);
    /*
    public function findEvents();
    public function add(Events $event);
    public function remove($id);
    */
}
