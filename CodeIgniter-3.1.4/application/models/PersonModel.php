<?php

/**
 * Created by PhpStorm.
 * User: Davide Pavone
 * Date: 28/04/2017
 * Time: 15:20
 */
class PersonModel extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getPersonen()
    {
        $query = $this->db->get('Persoon');
        return $query->result_array();
    }

    public function editPersoon()
    {
        $this->load->helper('url');

        $data = array(
            'persoonID' => $this->input->post('id'),
            'naam' => $this->input->post('naam')
        );

        $this->db->where('persoonID', $this->input->post('id'));
        return $this->db->update('persoon', $data);
    }
}