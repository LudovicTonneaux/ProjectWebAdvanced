<?php

/**
 * Created by PhpStorm.
 * User: BrianM
 * Date: 20/04/2017
 * Time: 14:15
 */
class PersoneelModel extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getPersonen(){
        $query = $this->db->get('persoon');
        return $query->result_array();
    }

    public function editPersoon(){
        $this->load->helper('url');

        $data = array(
            'persoonID' => $this->input->post('id'),
            'naam' => $this->input->post('name')
        );

        $this->db->where('persoonID',$this->input->post('id'));
        return $this->db->update('persoon', $data);
    }
}