<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription extends Home_Controller {

	public function __construct()
    {
        parent::__construct();

        if (!is_user()) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $data = array();
        $data['page_title'] = 'Subscription';
        $data['user'] = $this->common_model->get_my_package();
        $data['packages'] = $this->admin_model->select_asc('package');
        $data['features'] = $this->admin_model->select_asc('package_features');
        $data['main_content'] = $this->load->view('admin/user/subscription', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function upgrade($slug, $billing_type)
    {
        $data = array();
        $data['page_title'] = 'Upgrade';      
        $data['page'] = 'Payment'; 
        $payment = $this->common_model->get_user_payment();
        $data['payment_id'] = $payment->puid;
        $data['billing_type'] = $billing_type;
        $data['package'] = $this->common_model->get_package_by_slug($slug);
        $data['main_content'] = $this->load->view('admin/user/payment',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    //payment success
    public function payment_success($package_id, $payment_id)
    {   
        $data = array();
        $package = $this->common_model->get_package_by_id($package_id);
        $payment = $this->common_model->get_payment($payment_id);
        $pay_data = array(
            'package' => $package->id,
            'status' => 'verified',
            'amount' => $package->price,
            'created_at' => my_date_now()
        );
        $pay_data = $this->security->xss_clean($pay_data);
        if (!empty($payment)) {
            $this->common_model->edit_option($pay_data, $payment->id, 'payment');
        }
        $data['success_msg'] = 'Success';
        $data['main_content'] = $this->load->view('admin/user/payment_msg',$data,TRUE);
        $this->load->view('admin/index',$data);

    }


    //payment cancel
    public function payment_cancel($package_id, $payment_id)
    {   
        $data = array();
        $package = $this->common_model->get_package_by_id($package_id);
        $payment = $this->common_model->get_payment($payment_id);
        $pay_data = array(
            'package' => $package->id,
            'status' => 'pending',
            'amount' => $package->price,
            'created_at' => my_date_now()
        );
        $pay_data = $this->security->xss_clean($pay_data);
        $this->common_model->edit_option($pay_data, $payment->id,'payment');
        $data['error_msg'] = 'Error';
        $data['main_content'] = $this->load->view('admin/user/payment_msg',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

}