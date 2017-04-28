<?php

/**
 * Created by PhpStorm.
 * User: Davide Pavone
 * Date: 28/04/2017
 * Time: 15:20
 */
class EventsModel extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getEvents()
    {
        $query = $this->db->get('events');
        return $query->result_array();
    }

    public function editEvents()
    {
        $this->load->helper('url');

        $data = array(
            'eventsID' => $this->input->post('id'),
            'datum' => $this->input->post('datum')
        );

        $this->db->where('eventsID', $this->input->post('id'));
        return $this->db->update('events', $data);
    }
}