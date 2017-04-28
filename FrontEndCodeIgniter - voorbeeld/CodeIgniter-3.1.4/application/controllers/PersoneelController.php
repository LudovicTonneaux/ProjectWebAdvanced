<?php

/**
 * Created by PhpStorm.
 * User: BrianM
 * Date: 20/04/2017
 * Time: 13:53
 */
class PersoneelController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PersoneelModel');
        $this->load->helper('url_helper');
    }

    public function index(){
        $data['personeel'] = $this->PersoneelModel->getPersonen();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->view('urls/home' , $data);
    }

    public function editPersoon(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('urls/failed');
        }
        else
        {
            $this->PersoneelModel->editPersoon();
            $this::index();
        }
    }
}