<?php if (isset($page_title) && $page_title == 'Invoice Preview'){
    $status = 1;
    $logo = $this->business->logo;
    $business_name = $this->business->name;
    $business_address = $this->business->address;
    $country = $this->business->country;
    $title = $this->session->userdata('title');
    $summary = $this->session->userdata('summary');
    $customer_id = $this->session->userdata('customer');
    $number = $this->session->userdata('number');
    $date = $this->session->userdata('date');
    $payment_due = $this->session->userdata('payment_due');
    $due_limit = $this->session->userdata('due_limit');
    $sub_total = $this->session->userdata('sub_total');
    $tax = $this->session->userdata('tax');
    $discount = $this->session->userdata('discount');
    $grand_total = $this->session->userdata('grand_total');
    $footer_note = $this->session->userdata('footer_note');
}else{
    $status = $invoice->status;
    $logo = $invoice->logo;
    $business_name = $invoice->business_name;
    $business_address = $invoice->business_address;
    $country = $invoice->country;
    $title = $invoice->title;
    $summary = $invoice->summary;
    $customer_id = $invoice->customer;
    $number = $invoice->number;
    $date = $invoice->date;
    $payment_due = $invoice->payment_due;
    $due_limit = $invoice->due_limit;
    $sub_total = $invoice->sub_total;
    $tax = $invoice->tax;
    $discount = $invoice->discount;
    $grand_total = $invoice->grand_total;
    $footer_note = $invoice->footer_note;
}?>