<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense extends Home_Controller {

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
        $data['page_title'] = 'Expense';      
        $data['page'] = 'Expense';   
        $data['expense'] = FALSE;
        $data['vendors'] = $this->admin_model->get_by_user('vendors');
        $data['expenses'] = $this->admin_model->get_by_user('expenses');        
        $data['expense_category'] = $this->admin_model->get_product_categories($type=2);
        $data['main_content'] = $this->load->view('admin/user/expenses',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);
            //validate inputs
            $this->form_validation->set_rules('amount', "Amount", 'required|max_length[100]');
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/expense'));
            } else {
               
                $data=array(
                    'user_id' => user()->id,
                    'business_id' => $this->business->uid,
                    'amount' => $this->input->post('amount', true),
                    'category' => $this->input->post('category', true),
                    'vendor' => $this->input->post('vendor', true),
                    'notes' => $this->input->post('notes', true),
                    'date' => $this->input->post('date', true)
                );
                $data = $this->security->xss_clean($data);
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'expenses');
                    $this->session->set_flashdata('msg', 'Expense Edited Successfully'); 
                } else {
                    $id = $this->admin_model->insert($data, 'expenses');
                    $this->session->set_flashdata('msg', 'Expense added Successfully'); 
                }
                redirect(base_url('admin/expense'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['vendors'] = $this->admin_model->get_by_user('vendors');
        $data['expense'] = $this->admin_model->select_option($id, 'expenses');        
        $data['expense_category'] = $this->admin_model->get_product_categories($type=2);
        $data['main_content'] = $this->load->view('admin/user/expenses',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'Expenses');
        $this->session->set_flashdata('msg', 'Expense activate Successfully'); 
        redirect(base_url('admin/expense'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'expenses');
        $this->session->set_flashdata('msg', 'Expense deactivate Successfully'); 
        redirect(base_url('admin/expense'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'expenses'); 
        echo json_encode(array('st' => 1));
    }

}
	

