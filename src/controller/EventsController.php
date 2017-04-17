<?php

namespace controller;

use model\EventsRepository;
use view\View;

class EventsController
{
    private $eventsRepository;
    private $view;

    public function __construct(EventsRepository $eventsRepository, View $view)
    {
        $this->eventsRepository = $eventsRepository;
        $this->view = $view;
    }

    public function handleFindEventById($id = null)
    {
        $event = $this->eventsRepository->findEventById($id);
        $this->view->show(['events' => $event]);
    }
}
