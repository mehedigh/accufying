<?php $settings = get_settings(); ?>
<?php $currency_symbol = helper_get_customer($invoice->customer)->currency_symbol ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="col-md-10 m-auto">

                <div class="row">
                    <div class="col-md-4">
                        <h2 class="mt-0">Invoice #<?php echo html_escape($invoice->id) ?></h2>
                        <p>Created: <?php echo my_date_show($invoice->created_at); ?></p>
                    </div>

                    <div class="col-md-8 text-right">
                        <a href="<?php echo base_url('admin/invoice/edit/'.md5($invoice->id)) ?>" class="btn btn-default btn-rounded mr-5"><i class="icon-pencil"></i> Edit </a>
                        <div class="btn-group mr-5">
                            <button type="button" class="btn btn-default btn-rounded dropdown-toggle btn_trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <i class="icon-settings"></i> More Actions
                               <div class="circle circle-blue"></div>
                            </button>
                            <div class="dropdown-menu st" x-placement="bottom-start">
                                <a class="dropdown-item print_invoice" href="#">Print</a>
                                <!-- <a target="_blank" class="dropdown-item" href="<?php //echo base_url('readonly/export_pdf/'.md5($invoice->id)) ?>">Export as PDF</a> -->
                                <a class="dropdown-item" data-toggle="modal" href="#sendInvoiceModal_<?php echo html_escape($invoice->id) ?>">Send</a>
                                <a target="_blank" class="dropdown-item" href="<?php echo base_url('readonly/invoice/preview/'.md5($invoice->id)) ?>">Preview as a customer</a>
                                <a class="dropdown-item delete_item" href="<?php echo base_url('admin/invoice/delete/'.md5($invoice->id)) ?>">Delete</a>
                            </div>

                        </div>
                        <a href="<?php echo base_url('admin/invoice/create') ?>" class="btn btn-info btn-rounded"><i class="fa fa-plus"></i> New Invoice</a>
                    </div>
                    <input type="hidden" class="set_value" name="check_value">
                </div><br>
              


                <div class="row mb-0 p-0">
                    <div class="col-md-12 p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Customer</th>
                                    <th class="border-0">Amount due</th>
                                    <th class="border-0">Due</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>
                                        <?php if ($invoice->status == 0): ?>
                                            <span class="custom-label-sm label-light-default">Draft</span>
                                        <?php elseif($invoice->status == 1): ?>
                                            <span class="custom-label-sm label-light-info">Approved</span>
                                        <?php elseif($invoice->status == 2): ?>
                                            <span class="custom-label-sm label-light-success">Paid</span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if (!empty(helper_get_customer($invoice->customer))): ?>
                                            <?php echo helper_get_customer($invoice->customer)->name ?>
                                        <?php endif ?>
                                    </td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo html_escape($invoice->grand_total) ?></td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo html_escape($invoice->grand_total) ?></td>
                                </tr>

                                <tr>
                                    <td colspan="4">

                                        <!-- for regular invoices -->
                                        <?php if ($invoice->recurring == 0): ?>
                                            
                                            <?php if ($invoice->status == 0): ?>
                                                <div class="row mt-20">
                                                    <div class="col-md-12">
                                                        <div class="card br-10 b-warning bg-pending <?php if($invoice->status == 0){echo "dshadow";} ?>">
                                                            <div class="card-body bg-muted br-10">
                                                                <div class="m-l-10 align-self-center">
                                                                    <h3 class="mt-10 m-b-0">Draft Invoice
                                                                        <button data-id="<?php echo html_escape(md5($invoice->id)) ?>" type="button" class="pull-right btn btn-info btn-sm rounded approve_invoice"><i class="ti-check"></i> Approve </button>
                                                                    </h3>
                                                                    <h5 class="text-muteds m-b-0"><i class="icon-info"></i> This is a <strong>DRAFT</strong> invoice. You can take further actions once you approve it
                                                                    </h5>
                                                                    <p><strong>Created on:</strong> <?php echo my_date_show($invoice->created_at) ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="invoice-vertical-line"></div>
                                                </div>
                                            <?php endif ?>

                                            <div class="row mt-10">
                                                <div class="col-md-12">
                                                    <div class="card br-10 <?php if($invoice->status == 0){echo "is_disable";}elseif($invoice->status == 1){echo "dshadow";}else{echo "nshadow";} ?>">
                                                        <div class="card-body br-10">
                                                            <div class="m-l-10 align-self-center">
                                                                <h4 class="mt-10 m-b-0">Paid info 
                                                                    <?php if ($invoice->status != 2): ?>
                                                                        <button data-toggle="modal" data-target="#recordPayment" type="button" class="pull-right btn btn-info btn-sm rounded" <?php if($invoice->status == 0){echo "disabled";} ?>> Record a payment </button>
                                                                    <?php endif ?>
                                                                </h4>


                                                                <h5 class="text-muteds m-b-0">
                                                                <strong>
                                                                    Amount due: <?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?>
                                                                    <?php if($invoice->status == 2){echo "0.00";}else{echo html_escape($invoice->grand_total);} ?>
                                                                </strong>
                                                                </h5>

                                                                <?php if($invoice->status == 1): ?>
                                                                    <p class="text-warning"><strong>Status:</strong> Your invoice is awaiting payment</p>
                                                                <?php endif; ?>

                                                                <?php if ($invoice->status == 2): ?>
                                                                    <p class="text-success"><strong>Status:</strong> Your invoice is paid in full</p>
                                                                    <hr>
                                                                    <h5><strong>Payments received:</strong></h5>
                                                                    <p><?php my_date_show($invoice->created_at) ?> - A payment for <?php if(!empty($currency_symbol)){echo $currency_symbol;} ?><?php echo html_escape($invoice->grand_total) ?> ‎was made using Cash</p>
                                                                <?php endif ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invoice-vertical-line"></div>
                                            </div>

                                            <div class="row mt-10">
                                                <div class="col-md-12">
                                                    <div class="card br-10 <?php if($invoice->status == 0 || $invoice->status == 1){echo "is_disable";}else{if($invoice->is_sent == 0){echo "dshadow";}else{echo "nshadow";}} ?>">
                                                        <div class="card-body br-10">
                                                            <div class="m-l-10 align-self-center">

                                                                <h4 class="mt-10 m-b-0">Send invoice
                                                                    <?php if ($invoice->is_sent == 1): ?>
                                                                        <button data-toggle="modal" data-target="#sendInvoiceModal_<?php echo html_escape($invoice->id) ?>" type="button" class="pull-right btn btn-info btn-sm rounded mr-5" <?php if($invoice->status == 0 || $invoice->status == 1){echo "disabled";} ?>> Send Again </button>
                                                                    <?php else: ?>
                                                                        <!-- <a href="<?php //echo base_url('admin/invoice/edit/'.md5($invoice->id)) ?>" class="btn btn-default rounded pull-right"> Skip Send -->
                                                                        <?php if ($invoice->status == 2): ?>
                                                                            <!-- <div class="circler circle-blue pull-right"></div> -->
                                                                        <?php endif ?>
                                                                        </a>

                                                                        <button data-toggle="modal" data-target="#sendInvoiceModal_<?php echo html_escape($invoice->id) ?>" type="button" class="pull-right btn btn-info btn-sm rounded mr-5" <?php if($invoice->status == 0 || $invoice->status == 1){echo "disabled";} ?>> Send Invoice </button>
                                                                    <?php endif ?>
                                                                </h4>

                                                                <h5 class="text-muteds m-b-0">
                                                                    <p><strong>Last sent:</strong> 
                                                                    <?php if ($invoice->is_sent == 1): ?>
                                                                        <?php echo my_date_show_time($invoice->sent_date) ?>
                                                                    <?php else: ?>
                                                                        None
                                                                    <?php endif ?>
                                                                   </p>
                                                                </h5>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <!-- for recurring invoices -->
                                        <?php else: ?>
                                            <div class="row mt-20">
                                                <div class="col-md-12">
                                                    <div class="card br-10 nshadow">
                                                        <div class="card-body bg-muted br-10">
                                                            <div class="m-l-10 align-self-center">
                                                                <h3 class="mt-10 m-b-0">Create Invoice
                                                                    <a href="<?php echo base_url('admin/invoice/edit/'.md5($invoice->id).'/1') ?>" class="btn btn-default btn-rounded mr-5 pull-right"><i class="icon-pencil"></i> Edits </a>
                                                                </h3>
                                                                <p class="mb-0"><strong>Created on:</strong> <?php echo my_date_show($invoice->created_at) ?></p>
                                                                <p><strong>Payment terms:</strong> 
                                                                    <?php if ($invoice->due_limit == 1): ?>
                                                                        On Receipt
                                                                    <?php else: ?>
                                                                        Within <?php echo html_escape($invoice->due_limit) ?> days
                                                                    <?php endif ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invoice-vertical-line"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card br-10 <?php if($invoice->status == 0){echo "dshadow";}else{echo "nshadow";} ?>">
                                                        <div class="card-body bg-muted br-10">
                                                            <div class="m-l-10 align-self-center">
                                                                
                                                                <?php if (!empty($invoice->frequency)): ?>
                                                                    <h3 class="mt-10 mb-10">Invoice Schedule</h3>
                                                                    <p class="mb-0"><strong>Recurring start:</strong> <?php echo my_date_show($invoice->recurring_start) ?></p>
                                                                    <p class="mb-0"><strong>Recurring end:</strong> <?php echo my_date_show($invoice->recurring_end) ?></p>
                                                                    <p class="mb-0"><strong>Repeat invoice:</strong> <?php echo html_escape($invoice->frequency) ?> days</p>
                                                                <?php else: ?>
                                                                
                                                                    <h3 class="mt-10 mb-10">Set schedule</h3>
                                                                    <form id="recurring_form" method="post" class="validate-form" action="<?php echo base_url('admin/invoice/set_recurring/'.$invoice->id)?>" role="form" novalidate>
                                                                    
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                  <label>Start date <span class="text-danger">*</span></label>
                                                                                  <input type="text" class="form-control datepicker" required name="recurring_start" autocomplete="off">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                  <label>Repeat this invoice <span class="text-danger">*</span></label>
                                                                                  <select class="form-control" name="frequency">
                                                                                      <option value="">Select</option>
                                                                                      <option value="7">Weekly</option>
                                                                                      <option value="14">2 Weeks</option>
                                                                                      <option value="21">3 Weeks</option>
                                                                                      <option value="30">Monthly</option>
                                                                                      <option value="60">2 Months</option>
                                                                                      <option value="120">4 Months</option>
                                                                                      <option value="180">6 Months</option>
                                                                                      <option value="365">Yearly</option>
                                                                                      <option value="730">2 Year</option>
                                                                                      <option value="1095">3 Year</option>
                                                                                      <option value="1825">5 Year</option>
                                                                                  </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                  <label>End date <span class="text-danger">*</span></label>
                                                                                  <input type="text" class="form-control datepicker" required name="recurring_end" autocomplete="off">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-group mb-0">
                                                                                    <input type="checkbox" id="md_checkbox_1" class="filled-in chk-col-blue" value="1" name="auto_send">
                                                                                    <label for="md_checkbox_1"> Auto send invoice by e-mail</label>
                                                                                </div>

                                                                                <div class="form-group mt-0">
                                                                                    <input type="checkbox" id="md_checkbox_2" class="filled-in chk-col-blue" value="1" name="send_myself">
                                                                                    <label for="md_checkbox_2"> Email a copy of each invoice to myself</label>
                                                                                </div>
                                                                            </div>

                                                                            <button type="submit" class=" btn btn-info btn-sm rounded ml-15"><i class="ti-check"></i> Finish Setup</button>

                                                                        </div>

                                                                        <!-- csrf token -->
                                                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                                                    </form>

                                                                <?php endif ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="invoice_save_area mt-0" class="card inv save_area print_area">
                    <?php include"include/invoice_style_".$this->business->template_style.".php"; ?>
                </div>

            </div>
        </div>
    </section>
</div>


<?php include"include/send_invoice_modal.php"; ?>


<div id="recordPayment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom modal-md">
        <form id="record_payment_form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/invoice/record_payment')?>" role="form" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Record a payment for this invoice</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Record a payment you’ve already received, such as cash, cheque, or bank payment.</p><br>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label">Payment date</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" placeholder="yyyy/mm/dd" name="payment_date" value="<?php echo date('Y-m-d') ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-calender"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label">Payment due date</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" placeholder="Enter the due date for partial payment" name="due_date" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-calender"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label">Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="amount" value="<?php echo html_escape($invoice->grand_total - get_total_invoice_payments($invoice->id)) ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label">Payment method</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="tax" name="payment_method">
                                <option value="">Select payment method</option>
                                <?php $i=1; foreach (get_payment_methods() as $payment): ?>
                                    <option value="<?php echo $i; ?>"><?php echo html_escape($payment); ?></option>
                                <?php $i++; endforeach ?>
                            </select>  
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label">Memo / Notes</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="note"> </textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="invoice_id" value="<?php echo html_escape(md5($invoice->id)) ?>">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button type="submit" class="btn btn-info waves-effect pull-right">Add Payment</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
