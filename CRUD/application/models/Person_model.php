<?php

class Person_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get person by id
     */
    function get_person($id)
    {
        return $this->db->get_where('person',array('id'=>$id))->row_array();
    }
    
    /*
     * Get all person
     */
    function get_all_person()
    {
        return $this->db->get('person')->result_array();
    }
    
    /*
     * function to add new person
     */
    function add_person($params)
    {
        $this->db->insert('person',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update person
     */
    function update_person($id,$params)
    {
        $this->db->where('id',$id);
        $response = $this->db->update('person',$params);
        if($response)
        {
            return "person updated successfully";
        }
        else
        {
            return "Error occuring while updating person";
        }
    }
    
    /*
     * function to delete person
     */
    function delete_person($id)
    {
        $response = $this->db->delete('person',array('id'=>$id));
        if($response)
        {
            return "person deleted successfully";
        }
        else
        {
            return "Error occuring while deleting person";
        }
    }
}
