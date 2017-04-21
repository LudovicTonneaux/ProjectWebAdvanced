<?php

namespace controller;

use model\PersonRepository;
use view\View;

class PersonController
{
    private $personRepository;
    private $view;

    public function __construct(PersonRepository $personRepository, View $view)
    {
        $this->personRepository = $personRepository;
        $this->view = $view;
    }

    public function handleFindPersonById($id = null)
    {
        $persoon = $this->personRepository->findPersonById($id);
        $this->view->show(['persoon' => $persoon]);
    }

    public function handleFindPersonByEventsId($eventsId = null)
    {
        $persoon = $this->personRepository->findPersonById($eventsId);
        $this->view->show(['persoon' => $persoon]);
    }

    public function handleFindPersonByName($name = null)
    {
        $persoon = $this->personRepository->findPersonById($name);
        $this->view->show(['persoon' => $persoon]);
    }
}
