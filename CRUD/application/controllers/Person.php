<?php
 
class Person extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Person_model');
    } 

    /*
     * Listing of person
     */
    function index()
    {
        $data['person'] = $this->Person_model->get_all_person();

        $data['_view'] = 'person/index';
        $this->load->view('layouts/main',$data);
    }

    /*
    *  Listing of person by id
    */
    function id($id)
    {
        $person = $this->Person_model->get_person($id);
        $data['person'] = $person;

        // check if the person exists before trying to display it
        if(isset($person['id']))
        {
            $data['_view'] = 'person/id';
            $this->load->view('layouts/main',$data);
        }
        else
            show_error('The person you are trying to display does not exist.');
    }

    /*
     * Adding a new person
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('first_name','First Name','required|max_length[25]');
		$this->form_validation->set_rules('last_name','Last Name','required|max_length[25]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
            );
            
            $person_id = $this->Person_model->add_person($params);
            redirect('person/index');
        }
        else
        {            
            $data['_view'] = 'person/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a person
     */
    function edit($id)
    {   
        // check if the person exists before trying to edit it
        $data['person'] = $this->Person_model->get_person($id);
        
        if(isset($data['person']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('first_name','First Name','required|max_length[25]');
			$this->form_validation->set_rules('last_name','Last Name','required|max_length[25]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
                );

                $this->Person_model->update_person($id,$params);            
                redirect('person/index');
            }
            else
            {
                $data['_view'] = 'person/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The person you are trying to edit does not exist.');
    } 

    /*
     * Deleting person
     */
    function remove($id)
    {
        $person = $this->Person_model->get_person($id);

        // check if the person exists before trying to delete it
        if(isset($person['id']))
        {
            $this->Person_model->delete_person($id);
            redirect('person/index');
        }
        else
            show_error('The person you are trying to delete does not exist.');
    }
    
}
