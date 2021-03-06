<?php
 
class Event_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get event by id
     */
    function get_event($id)
    {
        return $this->db->get_where('event',array('id'=>$id))->row_array();
    }
    
    /*
     * Get all event
     */
    function get_all_event()
    {
        return $this->db->get('event')->result_array();
    }
    
    /*
     * function to add new event
     */
    function add_event($params)
    {
        $this->db->insert('event',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update event
     */
    function update_event($id,$params)
    {
        $this->db->where('id',$id);
        $response = $this->db->update('event',$params);
        if($response)
        {
            return "event updated successfully";
        }
        else
        {
            return "Error occuring while updating event";
        }
    }
    
    /*
     * function to delete event
     */
    function delete_event($id)
    {
        $response = $this->db->delete('event',array('id'=>$id));
        if($response)
        {
            return "event deleted successfully";
        }
        else
        {
            return "Error occuring while deleting event";
        }
    }
}
