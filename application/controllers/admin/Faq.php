<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_admin()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Faqs';  
        $data['faq'] = FALSE;
        $data['faqs'] = $this->admin_model->select('faqs');
        $data['main_content'] = $this->load->view('admin/faqs',$data,TRUE);
        $this->load->view('admin/index',$data);
    }



    public function add()
    {   
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            $data=array(
                'title' => $this->input->post('title', true),
                'details' => $this->input->post('details')
            );
            $data = $this->security->xss_clean($data);

            //if id available info will be edited
            if ($id != '') {
                $this->admin_model->edit_option($data, $id, 'faqs');
                $this->session->set_flashdata('msg', 'Faq Edited Successfully'); 
            } else {
                $id = $this->admin_model->insert($data, 'faqs');
                $this->session->set_flashdata('msg', 'Faq added Successfully'); 
            }
            redirect(base_url('admin/faq'));

        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['faq'] = $this->admin_model->select_option($id, 'faqs');
        $data['main_content'] = $this->load->view('admin/faqs',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'faqs');
        $this->session->set_flashdata('msg', 'Faq activate Successfully'); 
        redirect(base_url('admin/pages'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'faqs');
        $this->session->set_flashdata('msg', 'Faq deactivate Successfully'); 
        redirect(base_url('admin/pages'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'faqs'); 
        echo json_encode(array('st' => 1));
    }

}
    

