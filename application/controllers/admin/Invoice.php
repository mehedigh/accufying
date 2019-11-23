<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_user()) {
            redirect(base_url());
        }
    }


    public function type($status=0)
    {
        $data = array();
        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/invoice/type/'.$status);
        $total_row = $this->admin_model->get_invoices_by_type(1 , 0, 0, $status, $invoice=1);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 6;
        $this->pagination->initialize($config);
        
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }

        $data['page_title'] = 'Invoices';      
        $data['page'] = 'Invoice';
        $data['status'] = $status;
        $data['invoices'] = $this->admin_model->get_invoices_by_type(0 , $config['per_page'], $page * $config['per_page'], $status, $invoice=1);
        $data['customers'] = $this->admin_model->get_by_user('customers');
        $data['main_content'] = $this->load->view('admin/user/invoices',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function create($type=0)
    {
        $data = array();
        $data['page_title'] = 'Create Invoice';      
        $data['page'] = 'Invoice'; 
        $data['type'] = $type; 
        $data['invoice'] = FALSE;
        $data['products'] = $this->admin_model->get_by_user('products');
        $data['taxes'] = $this->admin_model->get_by_user('tax');
        $data['customers'] = $this->admin_model->get_by_user('customers');
        $data['total'] = $this->admin_model->get_total_by_user('invoice', 1);
        $data['main_content'] = $this->load->view('admin/user/invoice_create',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function edit($id, $type=0)
    {
        $data = array();
        $data['page_title'] = 'Edit Invoice';      
        $data['page_sub'] = 'Edit';      
        $data['page'] = 'Invoice'; 
        $data['type'] = $type;
        $data['invoice'] = $this->admin_model->get_by_md5_data($id, 'invoice');
        $data['products'] = $this->admin_model->get_by_user('products');
        $data['taxes'] = $this->admin_model->get_by_user('tax');
        $data['total'] = $this->admin_model->get_total_by_user('invoice', 1);
        $data['customers'] = $this->admin_model->get_by_user('customers');
        $data['main_content'] = $this->load->view('admin/user/invoice_create',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function add_product($product_id, $customer_id)
    {   
        $product = $this->admin_model->get_by_id($product_id, 'products');
        $customer = $this->admin_model->get_customer_info($customer_id, 'customers');

        $data = array();
        $data['taxes'] = $this->admin_model->get_by_user('tax');
        $data['product'] = $product; 

        if (!empty($product)) {
            if (empty($customer)) {
                $currency = '';
            }else{
                $currency = $customer->currency_symbol;
            }
            $loaded = $this->load->view('admin/user/include/product_list', $data, true);
            echo json_encode(array('st' => 1, 'loaded' => $loaded, 'currency' => $currency));
        }else{
            echo "Data not found";
        }
    }


    public function search_product($value)
    {   
        $products = $this->admin_model->search_product($value);
        $data = array();
        $data['products'] = $products; 
        if (!empty($products)) {
        
            $loaded = $this->load->view('admin/user/include/invoice_product_list', $data, true);
            echo json_encode(array('st' => 1, 'loaded' => $loaded));
        }else{
            echo json_encode(array('st' => 0));
        }
    }



    public function convert_currency($amount='', $from_currency='')
    {
        $result = ($amount / get_rate($from_currency)) * get_rate($this->business->currency_code);
        $rate = (1 / get_rate($from_currency)) * get_rate($this->business->currency_code);

        if ($from_currency == $this->business->currency_code) {
            $conversion = '';
            $convert_total = str_replace(",", "", $result);
        } else {
            $conversion = 'Currency conversion: ' . $this->business->currency_symbol . ' ' . number_format($result, 2) . ' (' . $this->business->currency_code . ') at ' . number_format($rate, 4);
            $convert_total = str_replace(",", "", $result);
        }
        echo json_encode(array('st' => 1, 'result' => $conversion, 'convert_total' => $convert_total));
    }

    
    
    //send email
    public function send($invoice_id)
    {   
          
        $customer_id = $this->input->post('customer_id', true);
        $is_myself = $this->input->post('is_myself', true);
        $invoice = $this->admin_model->get_invoice_details(md5($invoice_id));
        $customer = $this->admin_model->get_customer_info($customer_id);
        
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
        $data['logo'] = base_url($invoice->logo);
        $data['currency_code'] = $customer->currency_code;
        $data['currency_symbol'] = $customer->currency_symbol;
        $data['invoice'] = $invoice;
        $data['type'] = 'Invoice';
        $data['html_content'] = $this->load->view('email_template/invoice', $data, true);
        $send_data = $this->email_model->send($data['email_to'], $data['subject'], $data['html_content'], $data['email_myself']);
        
        if ($send_data == true) {
            $sent_data = array(
                'is_sent' => 1,
                'sent_date' => my_date_now()
            );
            $this->admin_model->edit_option($sent_data, $invoice_id, 'invoice');

            $data = array();
            $data['status'] = 1;
            echo json_encode($data);
        } else {
            $data = array();
            $data['status'] = 2;
            echo json_encode($data);
        }
        
    }


    public function save()
    {
        $data = array();
        $data['page_title'] = 'Invoice';      
        $data['page'] = 'Invoice'; 
        $data['products'] = $this->admin_model->get_by_user('invoice');
        $data['main_content'] = $this->load->view('admin/user/invoice_save',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function details($id)
    {
        $data = array();
        $data['invoice'] = $this->admin_model->get_invoice_details($id);
        $data['page_title'] = 'Invoice details';      
        $data['page'] = 'Invoice'; 
        $data['main_content'] = $this->load->view('admin/user/invoice_save',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function add()
    {
        $data = array();
        $id = $this->input->post('id', true);

        if ($this->settings->site_info == 1) {
            $total = $this->admin_model->count_invoices(1);
            if ($total > 20000) {
                $data['status'] = 4;
                echo json_encode($data);
                exit();
            }
        }
        //validate inputs
        $this->form_validation->set_rules('customer', "Add a customer to this invoice", 'required');
        if ($this->form_validation->run() === false) {
            $data['status'] = 3;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            $invoice = array(
                'user_id' => user()->id,
                'business_id' => $this->business->uid,
                'title' => $this->input->post('title', true),
                'summary' => $this->input->post('summary', true),
                'customer' => $this->input->post('customer', true),
                'number' => $this->input->post('number', true),
                'poso_number' => $this->input->post('poso_number', true),
                'recurring' => $this->input->post('is_recurring', true),
                'date' => $this->input->post('date', true),
                'tax' => $this->input->post('tax', true),
                'discount' => $this->input->post('discount', true),
                'payment_due' => $this->input->post('payment_due', true),
                'due_limit' => $this->input->post('due_limit', true),
                'footer_note' => $this->input->post('footer_note', true),
                'sub_total' => $this->input->post('sub_total', true),
                'grand_total' => $this->input->post('grand_total', true),
                'convert_total' => round($this->input->post('convert_total', true))
            );
            $invoice = $this->security->xss_clean($invoice);

            if (!empty($id)) {
                $this->admin_model->delete_items($id, 'invoice_items');
                $this->admin_model->edit_option($invoice, $id, 'invoice');
            } else {
               $id = $this->admin_model->insert($invoice, 'invoice');
            }
            
            $items = $this->input->post('items', true);
            $price = $this->input->post('price', true);
            $quantity = $this->input->post('quantity', true);
            $total_price = $this->input->post('total_price', true);

            if (!empty($items)) {
                for ($i=0; $i < count($items); $i++) { 
                    $item_data = array(
                        'invoice_id' => $id,
                        'item' => $items[$i],
                        'price' => $price[$i],
                        'qty' => $quantity[$i],
                        'total' => $total_price[$i]
                    );
                    $this->admin_model->insert($item_data, 'invoice_items');
                }
            }

            $data['status'] = 2;
            $data['invoice_id'] = md5($id);
            echo json_encode($data);

        }
        
    }

    public function preview()
    {
        $data = array();
        $invoice = array(
            'title' => $this->input->post('title', true),
            'summary' => $this->input->post('summary', true),
            'customer' => $this->input->post('customer', true),
            'number' => $this->input->post('number', true),
            'poso_number' => $this->input->post('poso_number', true),
            'date' => $this->input->post('date', true),
            'tax' => $this->input->post('tax', true),
            'discount' => $this->input->post('discount', true),
            'payment_due' => $this->input->post('payment_due', true),
            'due_limit' => $this->input->post('due_limit', true),
            'footer_note' => $this->input->post('footer_note', true),
            'sub_total' => $this->input->post('sub_total', true),
            'grand_total' => $this->input->post('grand_total', true),
            'convert_total' => $this->input->post('convert_total', true)
        );
        $this->session->set_userdata($invoice);

        $products = array(
            'item' => $this->input->post('items', true),
            'price' => $this->input->post('price', true),
            'quantity' => $this->input->post('quantity', true),
            'total_price' => $this->input->post('total_price', true)
        );
        $this->session->set_userdata($products);

        $data['page_title'] = 'Invoice Preview';      
        $data['page'] = 'Invoice'; 
        $load_data = $this->load->view('admin/user/invoice_preview', $data,TRUE);
        $data['status'] = 1;
        $data['load_data'] = $load_data;
        echo json_encode($data);
    }



    public function set_recurring($id)
    {   
        if($_POST)
        {   
            if(empty($this->input->post('auto_send', true))){$auto_send = 0;}else{$auto_send = 1;}
            if(empty($this->input->post('send_myself', true))){$send_myself = 0;}else{$send_myself = 1;}

            $data=array(
                'recurring_start' => $this->input->post('recurring_start', true),
                'recurring_end' => $this->input->post('recurring_end', true),
                'frequency' => $this->input->post('frequency', true),
                'auto_send' => $auto_send,
                'send_myself' => $send_myself,
                'status' => 1
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->update($data, $id, 'invoice');
            echo json_encode(array('st' => 1));
        }      
        
    }


    public function ajax_add_product()
    {   
        if($_POST)
        {   
            $data=array();
            $data=array(
                'user_id' => user()->id,
                'business_id' => $this->business->uid,
                'name' => $this->input->post('name', true),
                'price' => $this->input->post('price', true),
                'is_sell' => 0,
                'income_category' => 0,
                'is_buy' => 0,
                'expense_category' => 0,
                'details' => $this->input->post('details')
            );
            $data = $this->security->xss_clean($data);
            $id = $this->admin_model->insert($data, 'products');
            $data['products'] = $this->admin_model->get_by_user('products');
            $load_product = $this->load->view('admin/user/include/invoice_product_list', $data,TRUE);
            echo json_encode(array('st' => 1, 'load_product' => $load_product));
            
        }      
        
    }


    //add invoice payment record
    public function record_payment()
    {   
        if($_POST)
        {   
            $id = $this->input->post('invoice_id', true);
            $invoice = $this->admin_model->get_by_md5_id($id, 'invoice');
        
            $data=array(
                'payment_date' => $this->input->post('payment_date', true),
                'amount' => $this->input->post('amount', true),
                'customer_id' => $invoice->customer,
                'invoice_id' => $invoice->id,
                'business_id' => $this->business->uid,
                'payment_method' => $this->input->post('payment_method', true),
                'note' => $this->input->post('note', true)
            );
            $data = $this->security->xss_clean($data);
            $id = $this->admin_model->insert($data, 'payment_records');

            $total_payment = get_total_invoice_payments($invoice->id);

            if($total_payment == $invoice->grand_total){$status = 2;}else{$status = 1;}
            $invoice_data=array(
                'status' => $status,
                'payment_due' => $this->input->post('due_date', true)
            );
            $this->admin_model->edit_option($invoice_data, $invoice->id, 'invoice');
            redirect($_SERVER['HTTP_REFERER']);
        }      
        
    }

    public function approve_invoice($id) 
    {
        $invoice = $this->admin_model->get_by_md5_id($id, 'invoice');
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, $invoice->id, 'invoice');
        echo json_encode(array('st' => 1));
    }


    public function delete($id)
    {
        $this->admin_model->delete($id,'invoice'); 
        echo json_encode(array('st' => 1));
    }

}
	

