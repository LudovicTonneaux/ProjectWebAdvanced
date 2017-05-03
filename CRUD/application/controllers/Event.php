<?php
 
class Event extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Event_model');
    } 

    /*
     * Listing of event
     */
    function index()
    {
        $data['event'] = $this->Event_model->get_all_event();

        $data['_view'] = 'event/index';
        $this->load->view('layouts/main',$data);
    }

    /*
    * Listing of event by id
    */
    function id($id)
    {
        $event = $this->Event_model->get_event($id);
        $data['event'] = $event;

        // check if the event exists before trying to display it
        if(isset($event['id']))
        {
            $data['_view'] = 'event/id';
            $this->load->view('layouts/main',$data);
        }
        else
            show_error('The event you are trying to display does not exist.');
    }

    /*
     * Adding a new event
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('name','Name','required|max_length[25]');
		$this->form_validation->set_rules('date','Date','required');
		$this->form_validation->set_rules('person_id','Person Id','required|integer');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'person_id' => $this->input->post('person_id'),
				'name' => $this->input->post('name'),
				'date' => $this->input->post('date'),
            );
            
            $event_id = $this->Event_model->add_event($params);
            redirect('event/index');
        }
        else
        {
			$this->load->model('Person_model');
			$data['all_person'] = $this->Person_model->get_all_person();
            
            $data['_view'] = 'event/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a event
     */
    function edit($id)
    {   
        // check if the event exists before trying to edit it
        $data['event'] = $this->Event_model->get_event($id);
        
        if(isset($data['event']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('name','Name','required|max_length[25]');
			$this->form_validation->set_rules('date','Date','required');
			$this->form_validation->set_rules('person_id','Person Id','required|integer');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'person_id' => $this->input->post('person_id'),
					'name' => $this->input->post('name'),
					'date' => $this->input->post('date'),
                );

                $this->Event_model->update_event($id,$params);            
                redirect('event/index');
            }
            else
            {
				$this->load->model('Person_model');
				$data['all_person'] = $this->Person_model->get_all_person();

                $data['_view'] = 'event/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The event you are trying to edit does not exist.');
    } 

    /*
     * Deleting event
     */
    function remove($id)
    {
        $event = $this->Event_model->get_event($id);

        // check if the event exists before trying to delete it
        if(isset($event['id']))
        {
            $this->Event_model->delete_event($id);
            redirect('event/index');
        }
        else
            show_error('The event you are trying to delete does not exist.');
    }
    
}
