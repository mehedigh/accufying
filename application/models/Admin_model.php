<?php
class Admin_model extends CI_Model {

    // insert function
	public function insert($data,$table){
        $this->db->insert($table,$data);        
        return $this->db->insert_id();
    }

    // edit function
    function edit_option($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    } 

    // edit function
    function edit_option_md5($action, $id, $table){
        $this->db->where('md5(id)', $id);
        $this->db->update($table,$action);
        return;
    } 

    // update function
    function update($action,$id,$table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
    }

    // delete function
    function delete($id,$table){
        $this->db->delete($table, array('id' => $id));
        return;
    }

    // delete tags
    function delete_assaign_days($user_id, $table){
        $this->db->delete($table, array('user_id' => $user_id));
        return;
    }

    // edit function
    function update_currency($action, $code, $table){
        $this->db->where('code', $code);
        $this->db->update($table,$action);
        return;
    } 
  

    // get function
    function get($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // select by function
    function get_by_user($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('business_id', $this->business->uid);
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->order_by('user_id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // select function
    function select($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // asc select function
    function select_asc($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // select by id
    function select_option($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 

    // select by id
    function get_by_id($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    // select by id
    function get_by_md5_id($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('md5(id)', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    // select by id
    function get_by_md5_data($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('md5(id)', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 
    
    // get assaign days
    function get_user_days($user_id)
    {
        $this->db->select();
        $this->db->from('assaign_days');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }
   
    public function check_email($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }

    // get language
    function get_language()
    {
        $this->db->select();
        $this->db->from('language');
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // get language
    function get_language_values()
    {
        $this->db->select();
        $this->db->from('lang_values');
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // get language value pagination
    function get_lang_values($total, $limit, $offset)
    {
        $this->db->select('*');
        $this->db->from('lang_values');
        $this->db->order_by('id','DESC');
        
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }


    // get currency
    function get_currency()
    {
        $this->db->select();
        $this->db->from('currency');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // get currency
    function get_cur()
    {
        $this->db->select();
        $this->db->from('country');
        $this->db->group_by('currency_code');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // get rate
    function get_rates_date()
    {
        $this->db->select();
        $this->db->from('rates');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // get rates
    function get_rates($code)
    {
        $this->db->select();
        $this->db->from('rates');
        $this->db->where('code', $code);
        $query = $this->db->get();
        $query = $query->row();  
        return $query->rate;
    }


    // get_customer_info
    function get_customer_info($id)
    {
        $this->db->select('c.*, t.name as country, t.currency_name, t.currency_code, t.currency_symbol');
        $this->db->from('customers c');
        $this->db->join('country t', 't.id = c.country', 'LEFT');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    //get customer
    public function get_invoice_number($user_id, $type)
    {
        $this->db->where('type', $type);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('invoice');
        if ($query->num_rows() > 0) {
            return $query->num_rows() + 1;
        }else{
            return 1;
        }
        
    }

    // get_customer_info
    function get_readonly_invoice($id)
    {
        $this->db->select('i.*, b.name as business_name, b.address as business_address, b.template_style, b.logo, t.name as country');
        $this->db->from('invoice i');
        $this->db->join('business b', 'b.uid = i.business_id', 'LEFT');
        $this->db->join('country t', 't.id = b.country', 'LEFT');
        $this->db->where('md5(i.id)', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    // total function
    function get_total_by_user($table, $type)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('type', $type);
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }


    // get customer info
    function get_invoice_details($id)
    {
        $this->db->select('i.*, b.name as business_name, b.address as business_address, b.logo, t.name as country');
        $this->db->from('invoice i');
        $this->db->join('business b', 'b.uid = i.business_id', 'LEFT');
        $this->db->join('country t', 't.id = b.country', 'LEFT');
        $this->db->where('md5(i.id)', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 


    //get category
    public function get_category($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('category');
        return $query->row();
    }

    //get customer
    public function get_customer($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('customers');
        return $query->row();
    }


    //get customer
    public function get_customers()
    {
        $this->db->select('c.*, n.name as country_name, n.currency_name, n.currency_symbol, n.currency_code');
        $this->db->from('customers c');
        $this->db->where('business_id', $this->business->uid);
        $this->db->join('country n', 'n.id = c.country', 'LEFT');
        $this->db->order_by('c.id','DESC');
        $query = $this->db->get();
        return $query->result();
    }


    // get business
    function get_business($uid)
    {
        $this->db->select('b.*, n.name as country_name, n.currency_name, n.currency_symbol, n.currency_code, c.name as category_name');
        $this->db->from('business b');
        if ($uid != 0) {
            $this->db->where('b.uid', $uid);
        }
        $this->db->where('b.user_id', $this->session->userdata('id'));
        $this->db->join('country n', 'n.id = b.country', 'LEFT');
        $this->db->join('business_category c', 'c.id = b.category', 'LEFT');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // get business
    function get_single_business($id)
    {
        $this->db->select('b.*, n.name as country_name, n.currency_name, n.currency_symbol, n.currency_code, c.name as category_name');
        $this->db->from('business b');
        $this->db->where('b.id', $id);
        $this->db->join('country n', 'n.id = b.country', 'LEFT');
        $this->db->join('business_category c', 'c.id = b.category', 'LEFT');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    // get business
    function get_primary_business()
    {
        $this->db->select('b.*');
        $this->db->from('business b');
        $this->db->where('b.is_primary', 1);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //get product
    public function get_product($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        return $query->row();
    }


    //get product
    public function search_product($value)
    {
        if ($value != 'empty') {
            $this->db->like('name', $value);
        }
        $query = $this->db->get('products');
        return $query->result();
    }


    //get category
    public function get_category_option($id, $table)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    //get invoice items
    function get_invoice_items($id)
    {
        $this->db->select('i.*, p.name as item_name');
        $this->db->from('invoice_items i');
        $this->db->join('products p', 'p.id = i.item', 'LEFT');
        $this->db->where('i.invoice_id', $id);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    function get_subcategory($id)
    {
        $this->db->select();
        $this->db->from('category');
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    // get_categories
    function get_product_categories($type){
        $this->db->select();
        $this->db->from('categories');
        $this->db->where('business_id', $this->business->uid);
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('type', $type);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 


    //get invoice items
    function get_invoice_report_types($type, $limit)
    {
        $this->db->select('i.*, c.name as customer_name');
        $this->db->from('invoice i');
        $this->db->join('customers c', 'c.id = i.customer', 'LEFT');
        $this->db->where('i.user_id', $this->session->userdata('id'));
        $this->db->where('i.type', 1);
        $this->db->where('i.status', $type);
        $this->db->order_by('i.id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    //get report
    function get_income_report()
    {
        $this->db->select('r.*');
        $this->db->select_sum('r.amount', 'total');
        $this->db->from('payment_records r');
        $this->db->where("r.business_id", $this->business->uid);
        $this->db->group_by('r.payment_date');
        $this->db->order_by('r.payment_date', 'DESC');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get report
    function get_income_report_by_date($date)
    {
        $this->db->select('r.*');
        $this->db->select_sum('r.amount', 'total');
        $this->db->from('payment_records r');
        $this->db->group_by('r.payment_date');
        $this->db->where("DATE_FORMAT(r.payment_date,'%Y-%m')", $date);
        $this->db->where("r.business_id", $this->business->uid);
        $query = $this->db->get();
        $query = $query->result();
        if (empty($query)) {
            return 0;
        } else {
            return $query[0]->total;
        }
    }


    //get report
    function get_admin_income_by_date($date)
    {
        $this->db->select('r.*');
        $this->db->select_sum('r.amount', 'total');
        $this->db->from('payment r');
        $this->db->group_by('r.created_at');
        $this->db->where("DATE_FORMAT(r.created_at,'%Y-%m')", $date);
        $query = $this->db->get();
        $query = $query->result();
        if (empty($query)) {
            return 0;
        } else {
            return $query[0]->total;
        }
    }


    //get user report
    function get_income_by_year()
    {
        $this->db->select('r.*');
        $this->db->select_sum('r.amount', 'total');
        $this->db->from('payment_records r');
        $this->db->group_by("DATE_FORMAT(r.payment_date,'%Y')");
        $this->db->where("r.business_id", $this->business->uid);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get admin report
    function get_admin_income_by_year()
    {
        $this->db->select('r.*');
        $this->db->select_sum('r.amount', 'total');
        $this->db->from('payment r');
        $this->db->group_by("DATE_FORMAT(r.created_at,'%Y')");
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get packages
    function get_users_packages()
    {
        $this->db->select('count(p.id) as total, k.name');
        $this->db->from('payment p');
        $this->db->join('package k', 'k.id = p.package', 'LEFT');
        $this->db->group_by("package");
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get report
    function check_invoice_payment_records($invoice_id)
    {
        $this->db->select('r.*');
        $this->db->select_sum('r.amount', 'total');
        $this->db->from('payment_records r');
        $this->db->where("r.invoice_id", $invoice_id);
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }

    //get expense_report
    function get_expense_report_by_date($date)
    {
        $this->db->select('e.*');
        $this->db->select_sum('e.amount', 'total');
        $this->db->from('expenses e');
        $this->db->group_by('e.date');
        $this->db->where("DATE_FORMAT(e.date,'%Y-%m')", $date);
        $this->db->where("e.business_id", $this->business->uid);
        $query = $this->db->get();
        $query = $query->result();
        if (empty($query)) {
            return 0;
        } else {
            return $query[0]->total;
        }
    }


    //get expense
    function get_expense_by_year($year)
    {
        $this->db->select('e.*');
        $this->db->select_sum('e.amount', 'total');
        $this->db->from('expenses e');
        $this->db->group_by("DATE_FORMAT(e.date,'%Y')");
        $this->db->where("DATE_FORMAT(e.date,'%Y')", $year);
        $this->db->where("e.business_id", $this->business->uid);
        $query = $this->db->get();
        $query = $query->result();
        if (empty($query)) {
            return 0;
        } else {
            return $query[0]->total;
        }
    }


    //get tax
    function get_tax_by_product($product_id)
    {
        $this->db->select();
        $this->db->from('product_tax');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    // get invoices
    function get_invoices_by_type($total, $limit, $offset, $status, $type){
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('business_id', $this->business->uid);
        $this->db->where('user_id', $this->session->userdata('id'));
        if ($status != 3) {
            $this->db->where('status', $status);
        }
        if (isset($_GET['customer']) && $_GET['customer'] != '') {
            $this->db->where('customer', $_GET['customer']);
        }
        if (isset($_GET['status']) && $_GET['status'] != 3) {
            $this->db->where('status', $_GET['status']);
        }
        if (isset($_GET['status']) && $_GET['status'] == 3) {
            $this->db->where('is_sent', 1);
        }
        if (!empty($_GET['start_date']) || !empty($_GET['end_date'])) {
            $this->db->where("DATE_FORMAT(created_at,'%Y-%m-%d') > ", $_GET['start_date']);
            $this->db->where("DATE_FORMAT(created_at,'%Y-%m-%d') < ", $_GET['end_date']);
        }
        $this->db->where('type', $type);
        $this->db->order_by('id', 'DESC');

        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    } 
    

    // count invoices
    function count_invoices_by_type($status, $type){
        $this->db->select();
        $this->db->from('invoice');
        $this->db->where('business_id', $this->business->uid);
        $this->db->where('user_id', $this->session->userdata('id'));
        if ($status != 3) {
            $this->db->where('status', $status);
        }
        $this->db->where('type', $type);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    } 

    // count invoices
    function count_invoices($type){
        $this->db->select();
        $this->db->from('invoice');
        $this->db->where('type', $type);
        $query = $this->db->get();
        if (empty($query)) {
            return 0;
        }else{
            $query = $query->num_rows(); 
            return $query;
        }
    } 


    // get user reports
    function get_user_reports(){
        $this->db->select('*');
        $this->db->from('payment_records');
        $this->db->where('business_id', $this->business->uid);

        if (isset($_GET['customer']) && $_GET['customer'] != 0) {
            $this->db->where('customer_id', $_GET['customer']);
        }
      
        if (!empty($_GET['start_date']) || !empty($_GET['end_date'])) {
            $this->db->where("DATE_FORMAT(payment_date,'%Y-%m-%d') > ", $_GET['start_date']);
            $this->db->where("DATE_FORMAT(payment_date,'%Y-%m-%d') < ", $_GET['end_date']);
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    } 


    // count users
    function count_users(){
        $this->db->select();
        $this->db->from('users');
        $this->db->where('role', 'user');
        $query = $this->db->get();
        if (empty($query)) {
            return 0;
        }else{
            $query = $query->num_rows(); 
            return $query;
        }
    } 

    // count users
    function count_business(){
        $this->db->select();
        $this->db->from('business');
        $query = $this->db->get();
        if (empty($query)) {
            return 0;
        }else{
            $query = $query->num_rows(); 
            return $query;
        }
    } 

    // get single user info
    function get_settings()
    {
        $this->db->select();
        $this->db->from('settings');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    function get_font_by_slug($slug)
    {
        $this->db->select();
        $this->db->from('google_fonts');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // select by id
    function select_option_md5($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where(md5('id'), $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    //get user by id
    public function get_user_by_slug($slug)
    {
        $this->db->where('slug', $slug);
        $query = $this->db->get('users');
        return $query->row();
    }




    // get_categories
    function get_categories(){
        $this->db->select();
        $this->db->from('categories');
        $this->db->where('business_id', $this->business->uid);
        $this->db->where('parent_id', 0);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 


    // get blog posts
    function get_blog_posts(){
        $this->db->select('b.*');
        $this->db->select('c.slug as category_slug, c.name as category');
        $this->db->from('blog_posts b');
        $this->db->join('blog_category c', 'c.id = b.category_id', 'LEFT');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    } 


    //get posts categories
    function get_category_by_slug($slug)
    {
        $this->db->select();
        $this->db->from('blog_category');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //get category posts
    function get_category_posts($total, $limit, $offset, $id)
    {
        $this->db->select('p.*');
        $this->db->select('c.name as category, c.slug as category_slug');
        $this->db->from('blog_posts p');
        $this->db->join('blog_category as c', 'c.id = p.category_id', 'LEFT');
        $this->db->where('p.status', 1);
        $this->db->where('p.category_id', $id);
        
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit($limit);
        
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }


    //get category posts
    function count_posts_by_categories($id)
    {
        $this->db->select('count(p.id) as total');
        $this->db->from('blog_posts p');
        $this->db->where('p.status', 1);
        $this->db->where('p.category_id', $id);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->row();
        }else{
            return 0;
        }
    }


    // get_categories
    function get_blog_categories(){
        $this->db->select();
        $this->db->from('blog_category');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    //get latest users
    function get_latest_users($lilmit){
        $this->db->select('u.*, p.status as payment_status, p.package,p.expire_on, pk.name as package_name');
        $this->db->from('users u');
        $this->db->join('payment p', 'p.user_id = u.id', 'LEFT');
        $this->db->join('package pk', 'pk.id = p.package', 'LEFT');
        $this->db->where('u.role', 'user');
        $this->db->order_by('u.id','DESC');
        $this->db->group_by('u.id');
        $this->db->limit($lilmit);
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    // count active, inactive and total user
    function get_user_total(){
        $this->db->select('count(*) as total');
        $this->db->select('(SELECT count(users.id)
                            FROM users 
                            WHERE (users.status = 1) AND (users.account_type = "pro")
                            )
                            AS pro_user',TRUE);

        $this->db->select('(SELECT count(users.id)
                            FROM users 
                            WHERE (users.status = 1) AND (users.account_type = "free")
                            )
                            AS free_user',TRUE);

        $this->db->select('(SELECT count(users.id)
                            FROM users 
                            WHERE (users.status = 0)
                            )
                            AS pending_user',TRUE);

        $this->db->from('users');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // get all posts
    function active_langs(){
        gets_active_langs();
    }

    // get all posts
    function get_latest_messages(){
        $this->db->select('c.*');
        $this->db->from('contacts c');
        $this->db->order_by('c.id','DESC');
        $this->db->limit(8);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get tagfs
    function get_tags($post_id)
    {
        $this->db->select();
        $this->db->from('tags');
        $this->db->where('post_id', $post_id);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    // delete tags
    function delete_tags($post_id, $table){
        $this->db->delete($table, array('post_id' => $post_id));
        return;
    }

    // delete tax
    function delete_tax($product_id, $table){
        $this->db->delete($table, array('product_id' => $product_id));
        return;
    }

    // delete tax
    function delete_items($invoice_id, $table){
        $this->db->delete($table, array('invoice_id' => $invoice_id));
        return;
    }

    // get all users
    function get_all_users($total, $limit, $offset, $type){
        $this->db->select('u.*, p.status as payment_status, p.package,p.expire_on, pk.name as package_name');
        $this->db->from('users u');
        $this->db->join('payment p', 'p.user_id = u.id', 'LEFT');
        $this->db->join('package pk', 'pk.id = p.package', 'LEFT');
        $this->db->where('u.role', 'user');
        if ($type != 'all') {
            $this->db->where('u.account_type', $type);
        }
        $this->db->order_by('u.id','DESC');
        $this->db->group_by('u.id');
        $this->db->query('SET SQL_BIG_SELECTS=1');

        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            foreach ($query as $key => $value) {
                $this->db->select('*');
                $this->db->from('business b');
                $this->db->where('b.user_id',$value->id);
                $query2 = $this->db->get();
                $query2 = $query2->result();
                $query[$key]->business = $query2;
            }
            return $query;
        }
    }


    // get images by user
    function get_total_info(){
        $this->db->select('p.id');
        $this->db->select('(SELECT count(posts.id)
                            FROM posts 
                            WHERE (status = 1)
                            )
                            AS post',TRUE);
        
        $this->db->select('(SELECT count(users.id)
                            FROM users 
                            WHERE (status = 1)
                            )
                            AS user',TRUE);

        $this->db->from('posts p');
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


    //get user info
    function get_user_info()
    {
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // image upload function with resize option
    function upload_image($max_size){
            
            // set upload path
            $config['upload_path']  = "./uploads/";
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['max_size']     = '92000';
            $config['max_width']    = '92000';
            $config['max_height']   = '92000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("photo")) {

                
                $data = $this->upload->data();

                // set upload path
                $source             = "./uploads/".$data['file_name'] ;
                $destination_thumb  = "./uploads/thumbnail/" ;
                $destination_medium = "./uploads/medium/" ;
                $main_img = $data['file_name'];
                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_medium   = $max_size ;
                $limit_thumb    = 150;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
                    $percent_medium = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = ' 100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                ////// Making MEDIUM /////////////
                $img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $mid = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                // set upload path
                $images = 'uploads/medium/'.$mid;
                $thumb  = 'uploads/thumbnail/'.$thumb_nail;
                unlink($source) ;

                return array(
                    'images' => $images,
                    'thumb' => $thumb
                );
            }
            else {
                echo "Failed! to upload image" ;
            }
            
    }


    //multiple image upload with resize option
    public function do_upload($photo) {                   
        $config['upload_path']  = "./uploads/";
        $config['allowed_types']= 'gif|jpg|png|jpeg';
        $config['max_size']     = '20000';
        $config['max_width']    = '20000';
        $config['max_height']   = '20000';
 
        $this->load->library('upload', $config);                
        
            if ($this->upload->do_upload($photo)) {
                $data       = $this->upload->data(); 
                /* PATH */
                $source             = "./uploads/".$data['file_name'] ;
                $destination_thumb  = "./uploads/thumbnail/" ;
                $destination_medium = "./uploads/medium/" ;
                $destination_big    = "./uploads/big/" ;

                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_big   = 1000 ;
                $limit_medium    = 400 ;
                $limit_thumb    = 100 ;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_big || $limit_use > $limit_thumb || $limit_use > $limit_medium) {
                    $percent_big = $limit_big/$limit_use ;
                    $percent_medium  = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;                 

                //// Making MEDIUM ///////
                $img['width']  = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $medium = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;               

                ////// Making BIG /////////////
                $img['width']   = $limit_use > $limit_big ?  $data['image_width'] * $percent_big : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_big ?  $data['image_height'] * $percent_big : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_big-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_big ;

                $album_picture = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                $data_image = array(
                    'thumb' => 'uploads/thumbnail/'.$thumb_nail,
                    'medium' => 'uploads/medium/'.$medium,
                    'big' => 'uploads/big/'.$album_picture
                );

                unlink($source) ;   
                return $data_image;   
    
            }
            else {
                return FALSE ;
            }
       
    }

}