<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Business extends Home_Controller {

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
        $data['page_title'] = 'Business';
        $data['page'] = 'Business';
        $data['busines'] = FALSE;
        $data['business'] = $this->admin_model->get_business(0);
        $data['total'] = count($data['business']);
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['categories'] = $this->admin_model->select_asc('business_category');
        $data['main_content'] = $this->load->view('admin/user/business',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {   
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "Customer Name", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/business'));
            } else {

                if ($id != '') {
                    $business = $this->admin_model->get_single_business($id);
                    $uid = $business[0]['uid'];
                    $country = $business[0]['country'];
                }else{
                    $uid = random_string('numeric',5);
                    $country = $this->input->post('country', true);
                }

                $data=array(
                    'user_id' => user()->id,
                    'uid' => $uid,
                    'title' => $this->input->post('title', true),
                    'name' => $this->input->post('name', true),
                    'address' => $this->input->post('address', true),
                    'country' =>$country ,
                    'category' => $this->input->post('category', true),
                    'status' => 1
                );
                $data = $this->security->xss_clean($data);
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'business');
                    $this->session->set_flashdata('msg', 'Business Edited Successfully'); 
                } else {
                    $id = $this->admin_model->insert($data, 'business');
                    $this->session->set_flashdata('msg', 'New Business added Successfully'); 
                }

                // upload logo
                $data_img = $this->admin_model->do_upload('photo1');
                if($data_img){

                    $data_img = array(
                        'logo' => $data_img['medium']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'business'); 
                 }

                redirect(base_url('admin/business'));
            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['page'] = 'Business';
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['categories'] = $this->admin_model->select_asc('business_category');
        $data['busines'] = $this->admin_model->get_single_business($id);
        $data['main_content'] = $this->load->view('admin/user/business',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function set_primary($id) 
    {
        $business = $this->admin_model->get_primary_business();
        if (!empty($business)) {
            $udata = array(
                'is_primary' => 0
            );
            $this->admin_model->update($udata, $business->id,'business');
        }

        $data = array(
            'is_primary' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'business');
        echo json_encode(array('st' => 1));
    }


    public function invoice_customize() 
    {
        if($_POST)
        {   
            $data = array(
                'template_style' => $this->input->post('template_style', true),
                'color' => $this->input->post('color', true)
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->update($data, $this->business->id, 'business');
            $this->session->set_flashdata('msg', 'Updated Successfully'); 
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['page_title'] = 'Invoice Customization';   
        $data['page'] = 'Invoice';   
        $data['business'] = $this->admin_model->get_business(0);
        $data['main_content'] = $this->load->view('admin/user/invoice_customize',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'business');
        $this->session->set_flashdata('msg', 'Business activate Successfully'); 
        redirect(base_url('admin/business'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'business');
        $this->session->set_flashdata('msg', 'Business deactivate Successfully'); 
        redirect(base_url('admin/business'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'business'); 
        echo json_encode(array('st' => 1));
    }


}