<div class="content-wrapper">
    <section class="content">
        <div class="container">
        	<div class="row">
            	<div class="col-md-12">
            		<h2>Invoices  <a href="<?php echo base_url('admin/invoice/create') ?>" class="btn btn-info btn-rounded pull-right"><i class="fa fa-plus"></i> Create New Invoice</a></h2>

                    <form method="GET" class="sort_invoice_form" action="<?php echo base_url('admin/invoice/type/'.$status) ?>">
                        <div class="row p-15 mt-20 mb-20">
                            <div class="col-md-4 col-xs-12 mt-5 pl-0">
                                <select class="form-control single_select sort" name="customer">
                                    <option value="">All Customers</option>
                                    <?php foreach ($customers as $customer): ?>
                                      <option value="<?php echo html_escape($customer->id) ?>" <?php echo(isset($_GET['customer']) && $_GET['customer'] == $customer->id) ? 'selected' : ''; ?>
                                      ><?php echo html_escape($customer->name) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-3 col-xs-12 mt-5 pl-0">
                                <select class="form-control single_select sort" name="status">
                                   <option value="">All Status</option>
                                   <option value="2" <?php echo(isset($_GET['status']) && $_GET['status'] == 2) ? 'selected' : ''; ?> >Paid</option>
                                   <option value="1" <?php echo(isset($_GET['status']) && $_GET['status'] == 1) ? 'selected' : ''; ?> >Unpaid</option>
                                   <option value="0" <?php echo(isset($_GET['status']) && $_GET['status'] == 0) ? 'selected' : ''; ?> >Draft</option>
                                   <option value="3" <?php echo(isset($_GET['status']) && $_GET['status'] == 3) ? 'selected' : ''; ?> >Sent</option>
                                </select>
                            </div>

                            <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                <div class="input-group">
                                    <input type="text" class="inv-dpick form-control datepicker" placeholder="From" name="start_date" value="<?php if(isset($_GET['start_date'])){echo $_GET['start_date'];} ?>" autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                <div class="input-group">
                                    <input type="text" class="inv-dpick form-control datepicker" placeholder="To" name="end_date" value="<?php if(isset($_GET['end_date'])){echo $_GET['end_date'];} ?>" autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        
                            <div class="col-md-1 col-xs-12 mt-5 pl-0">
                                <button type="submit" class="btn btn-info btn-report btn-block custom_search"><i class="flaticon-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </form>
            		
            		<ul class="nav nav-tabs custab" role="tablist">
                        <li class="nav-item"> <a class="nav-link <?php if($status == 1){echo "active";} ?>" href="<?php echo base_url('admin/invoice/type/1') ?>" role="tab" aria-selected="true"> <span class="hidden-xs-downs">Unpaid <span class="label-count"><?php echo helper_count_invoices($istatus=1, $type=1) ?></span></span></a> </li>
                        <li class="nav-item"> <a class="nav-link <?php if($status == 0){echo "active";} ?>" href="<?php echo base_url('admin/invoice/type/0') ?>" role="tab" aria-selected="false"> <span class="hidden-xs-downs">Draft <span class="label-count"><?php echo helper_count_invoices($istatus=0, $type=1) ?></span></span></a> </li>
                        <li class="nav-item"> <a class="nav-link <?php if($status == 3){echo "active";} ?>" href="<?php echo base_url('admin/invoice/type/3') ?>" role="tab" aria-selected="false"> <span class="hidden-xs-downs">All Invoices <span class="label-count"><?php echo helper_count_invoices($istatus=3, $type=1) ?></span></span></a> </li>
                    </ul>


                    <div class="tab-content">
                        <!-- All -->
                        <div class="tab-pane active" id="messages2" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="item-row">
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Number</th>
                                            <th>Customer</th>
                                            <th>Total</th>
                                            <th>Amount Due</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($invoices as $invoice): ?>
                                            <tr id="row_<?php echo html_escape($invoice->id) ?>">
                                                <td>
                                                    <?php if ($invoice->status == 0): ?>
                                                        <span data-toggle="tooltip" data-placement="right" title="You created this invoice, but you have not approved it." class="custom-label-sm label-light-default">Draft</span>
                                                    <?php elseif($invoice->status == 2): ?>
                                                        <span data-toggle="tooltip" data-placement="right" title="Your customer has paid this invoice in full." class="custom-label-sm label-light-success">Paid</span>
                                                    <?php elseif($invoice->status == 1): ?>
                                                        <span data-toggle="tooltip" data-placement="right" title="Your customer has not paid the full invoice amount on time." class="custom-label-sm label-light-danger">Unpaid</span>
                                                    <?php endif ?>
                                                </td>
                                                
                                                <td><?php echo my_date_show($invoice->created_at); ?></td>
                                                <td>
                                                    <p class="mb-0"> <?php echo html_escape($invoice->number) ?> </p>
                                                    <?php if ($invoice->recurring == 1): ?>
                                                        <strong>Recurring</strong>
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty(helper_get_customer($invoice->customer))): ?>
                                                        <?php echo helper_get_customer($invoice->customer)->name ?>
                                                        <?php $currency_symbol = helper_get_customer($invoice->customer)->currency_symbol ?>
                                                        <?php $currency_code = helper_get_customer($invoice->customer)->currency_code ?>
                                                    <?php endif ?>
                                                </td>

                                                <?php if($invoice->status == 2): ?>
                                                    <td>
                                                        <span class="total-price"><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo html_escape($invoice->grand_total) ?> <?php if(!empty($currency_code)){echo html_escape($currency_code);} ?></span><br>
                                                        <span class="conver-total"><?php echo $this->business->currency_symbol.''.$invoice->convert_total.' '.user()->currency_code ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="total-price"><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?>0.00 <?php if(!empty($currency_code)){echo html_escape($currency_code);} ?></span>
                                                        <br>
                                                        <span class="conver-total"><?php echo $this->business->currency_symbol.'0.00'.user()->currency_code ?></span>
                                                    </td>
                                                <?php else: ?>
                                                    <td>
                                                        <span class="total-price"><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo html_escape($invoice->grand_total) ?> <?php if(!empty($currency_code)){echo html_escape($currency_code);} ?></span><br>
                                                        <span class="conver-total"><?php echo $this->business->currency_symbol.''.$invoice->convert_total.' '.user()->currency_code ?></span>
                                                    </td>
                                                    <td class="text-danger">
                                                        <span class="total-price"><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo $invoice->grand_total - get_total_invoice_payments($invoice->id); ?> <?php if(!empty($currency_code)){echo html_escape($currency_code);} ?></span>
                                                            <br>
                                                            <?php if ($invoice->status != 1): ?>
                                                                
                                                                <span class="conver-total"><?php echo $this->business->currency_symbol.''.$invoice->convert_total.' '.user()->currency_code ?></span>
                                                            <?php endif ?>
                                                        </td>
                                                <?php endif ?>

                                                <td class="text-right">
                                                    <?php if($invoice->status == 2): ?>
                                                         <a target="_blank" class="mr-5" href="<?php echo base_url('admin/invoice/details/'.md5($invoice->id)) ?>">View</a>
                                                    <?php elseif($invoice->status == 0): ?>
                                                        <a class="mr-5 approve_item" href="<?php echo base_url('admin/invoice/approve_invoice/'.md5($invoice->id)) ?>">Approve</a>
                                                    <?php else: ?>
                                                         <a class="mr-5" href="#recordPayment_<?php echo html_escape($invoice->id) ?>" data-toggle="modal">Record a payment</a>
                                                    <?php endif ?>

                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default rounded btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                           More
                                                        </button>
                                                        <div class="dropdown-menu st" x-placement="bottom-start">
                                                            <?php if($invoice->status != 2): ?>
                                                            <a class="dropdown-item" href="<?php echo base_url('admin/invoice/details/'.md5($invoice->id)) ?>">View</a>
                                                            <?php endif ?>
                                                            <a class="dropdown-item" data-toggle="modal" href="#sendInvoiceModal_<?php echo html_escape($invoice->id) ?>">Send</a>
                                                            <a class="dropdown-item" href="<?php echo base_url('admin/invoice/details/'.md5($invoice->id)) ?>">Print</a>
                                                            
                                                            <a target="_blank" class="dropdown-item" href="<?php echo base_url('readonly/invoice/preview/'.md5($invoice->id)) ?>">Preview as a customer</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="<?php echo base_url('admin/invoice/edit/'.md5($invoice->id)) ?>">Edit </a>
                                                            <a class="dropdown-item delete_item" href="<?php echo base_url('admin/invoice/delete/'.md5($invoice->id)) ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12 text-center mt-50">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </section>
</div>


<?php foreach ($invoices as $invoice): ?>
    <?php include"include/send_invoice_modal.php"; ?>
<?php endforeach; ?>


<?php foreach ($invoices as $invoice): ?>
<div id="recordPayment_<?php echo html_escape($invoice->id) ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom modal-md">
        <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/invoice/record_payment')?>" role="form" novalidate>
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Record a payment for this invoice</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
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
<?php endforeach; ?>


