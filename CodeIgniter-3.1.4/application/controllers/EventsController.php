<?php

namespace controller;


class EventsController extends \CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('EventsModel');
        $this->load->helper('url_helper');
        //$this->eventsRepository = $eventsRepository;
        //$this->view = $view;
    }

    public function index()
    {
        $data['events'] = $this->events->getEventsID();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->view('urls/home', $data);
    }

    public function editEvents()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('datum', 'datum', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('urls/failed');
        } else {
            $this->PersoneelModel->editEvents();
            $this::index();
        }
    }

    /* public function handleFindEventById($id = null)
     {
         $event = $this->eventsRepository->findEventById($id);
         $this->view->show(['events' => $event]);
     }

     public function handleFindEventByPersonId($personId = null)
     {
         $event = $this->eventsRepository->findEventById($personId);
         $this->view->show(['events' => $event]);
     }

     public function handleFindEventByDate($date = null)
     {
         $event = $this->eventsRepository->findEventById($date);
         $this->view->show(['events' => $event]);
     }*/
}
