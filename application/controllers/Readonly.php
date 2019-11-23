<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Readonly extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
    }


    public function export_pdf($id)
    {
        $data = array();
        $data['invoice'] = $this->admin_model->get_invoice_details($id);
        $data['page_title'] = 'Estimate Export';      
        $data['page'] = 'Estimate';
        //load library
        $this->load->library('pdf');
        //load view page
        $this->pdf->load_view('admin/user/estimate_view', $data);
        $this->pdf->render();
        $this->pdf->stream("invoice.pdf");
    }

    public function estimate($mode, $id)
    {
        $data = array();
        $data['mode'] = $mode;       
        if ($mode == 'preview') {   
            $data['link'] = $_SERVER['HTTP_REFERER'];
        } 
        $data['invoice'] = $this->admin_model->get_readonly_invoice($id);
        $data['page_title'] = 'Estimate preview'; 
        $data['page'] = 'Estimate';
        $this->load->view('admin/user/estimate_view',$data);
    }

    public function invoice($mode, $id)
    {
        $data = array();
        $data['invoice'] = $this->admin_model->get_readonly_invoice($id);
        $data['mode'] = $mode;   
        if ($mode == 'preview') {   
            $data['link'] = $_SERVER['HTTP_REFERER'];
        } 
        $data['page_title'] = 'Invoice preview';      
        $data['page'] = 'Invoce';
        $this->load->view('admin/user/invoice_view',$data);
    }

    public function inv(){

        $invoice = $this->admin_model->get_by_md5_id(md5(1), 'invoice');
        $data = array();
        if (isset($is_myself)) {
            $data['email_myself'] = $this->input->post('email_myself', true);
        } else {
            $data['email_myself'] = '';
        }

        $data['email_to'] = $this->input->post('email_to', true);
        $data['message'] = $this->input->post('message', true);
        $data['subject'] = $this->input->post('subject', true);
        $data['invoice'] = $invoice;
        $this->load->view('email_template/invoice',$data);
    }


    // not found page
    public function error_404()
    {
        $data['page_title'] = "Error 404";
        $data['description'] = "Error 404";
        $data['keywords'] = "error,404";
        $this->load->view('error_404');
    }


}