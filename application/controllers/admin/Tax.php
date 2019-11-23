<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_user()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Tax';      
        $data['page'] = 'Tax';   
        $data['tax'] = FALSE;
        $data['taxes'] = $this->admin_model->get_by_user('tax');
        $data['main_content'] = $this->load->view('admin/user/tax',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "Tax Name", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/tax'));
            } else {

                if(!empty($this->input->post('is_invoices'))){$is_invoices = 1;}else{$is_invoices = 0;}
                if(!empty($this->input->post('is_recoverable'))){$is_recoverable = 1;}else{$is_recoverable = 0;}
               
                $data=array(
                    'user_id' => user()->id,
                    'business_id' => $this->business->uid,
                    'name' => $this->input->post('name', true),
                    'rate' => $this->input->post('rate', true),
                    'number' => $this->input->post('number', true),
                    'details' => $this->input->post('details', true),
                    'is_invoices' => $is_invoices
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'tax');
                    $this->session->set_flashdata('msg', 'Tax Edited Successfully'); 
                } else {
                    $id = $this->admin_model->insert($data, 'tax');
                    $this->session->set_flashdata('msg', 'Tax added Successfully'); 
                }
                redirect(base_url('admin/tax'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['tax'] = $this->admin_model->select_option($id, 'tax');
        $data['main_content'] = $this->load->view('admin/user/tax',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function delete($id)
    {
        $this->admin_model->delete($id,'tax'); 
        echo json_encode(array('st' => 1));
    }

}
	

