<div class="content-wrapper">
    <section class="content">
        <div class="container">
        	<div class="row">
            	<div class="col-md-12">
            		<h2 class="p-10">Estimates  <a href="<?php echo base_url('admin/estimate/create') ?>" class="btn btn-info btn-rounded pull-right"><i class="fa fa-plus"></i> New Estimate</a></h2>
            	    
                    <form method="GET" class="sort_invoice_form" action="<?php echo base_url('admin/estimate') ?>">
                        <div class="row p-15 mt-20 mb-20">
                            <div class="col-md-5 col-xs-12 mt-5 pl-0">
                                <select class="form-control single_select sort" name="customer">
                                    <option value="">All Customers</option>
                                    <?php foreach ($customers as $customer): ?>
                                      <option value="<?php echo html_escape($customer->id) ?>" <?php echo(isset($_GET['customer']) && $_GET['customer'] == $customer->id) ? 'selected' : ''; ?>
                                      ><?php echo html_escape($customer->name) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-3 col-xs-12 mt-5 pl-0">
                                <div class="input-group">
                                    <input type="text" class="inv-dpick form-control datepicker" placeholder="From" name="start_date" value="<?php if(isset($_GET['start_date'])){echo $_GET['start_date'];} ?>" autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12 mt-5 pl-0">
                                <div class="input-group">
                                    <input type="text" class="inv-dpick form-control datepicker" placeholder="To" name="end_date" value="<?php if(isset($_GET['end_date'])){echo $_GET['end_date'];} ?>" autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        
                            <div class="col-md-1 col-xs-12 mt-5 pl-0">
                                <button type="submit" class="btn btn-default btn-block custom_search"><i class="flaticon-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </form>


                    <div class="tab-content">
                        <!-- unpaid -->
                        <div class="tab-pane active" id="home2" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="item-row">
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Number</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($estimates)): ?>
                                            <tr>
                                                <td colspan="6" class="text-center"><strong>No data found !</strong></td>
                                            </tr>
                                        <?php else: ?>

                                            <?php foreach ($estimates as $estimate): ?>
                                                <tr>
                                                    <td>
                                                        <?php if (date("Y-m-d") > date("Y-m-d", strtotime($estimate->created_at))): ?>
                                                            <span data-toggle="tooltip" data-placement="right" title="Your estimate is expire now" class="custom-label-sm label-light-danger">Expire</span>
                                                        <?php else: ?>
                                                            <span data-toggle="tooltip" data-placement="right" title="Your estimate is saved" class="custom-label-sm label-light-success">Saved</span>
                                                         <?php endif; ?>
                                                    </td>
                                                    <td><?php echo my_date_show($estimate->created_at); ?></td>
                                                    <td><?php echo html_escape($estimate->number) ?></td>
                                                    <td>
                                                        <?php if (!empty(helper_get_customer($estimate->customer))): ?>
                                                            <?php echo helper_get_customer($estimate->customer)->name ?>
                                                            <?php $currency_symbol = helper_get_customer($estimate->customer)->currency_symbol ?>
                                                        <?php endif ?>
                                                    </td>
                                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo html_escape($estimate->grand_total) ?></td>
                                                    <td class="text-right">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default rounded btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               Actions
                                                            </button>
                                                            <div class="dropdown-menu st" x-placement="bottom-start">
                                                                <a class="dropdown-item" href="<?php echo base_url('admin/estimate/details/'.md5($estimate->id)) ?>">View</a>
                                                                <a class="dropdown-item" data-toggle="modal" href="#sendEstimateModal_<?php echo html_escape($estimate->id) ?>">Send</a>
                                                                <a target="_blank" class="dropdown-item" href="<?php echo base_url('readonly/estimate/preview/'.md5($estimate->id)) ?>">Preview as a customer</a>
                                                                <a class="dropdown-item" href="<?php echo base_url('admin/estimate/details/'.md5($estimate->id)) ?>">Print</a>
                                                                <a class="dropdown-item" href="<?php echo base_url('readonly/export_pdf/'.md5($estimate->id)) ?>">Export as PDF</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item delete_item" href="<?php echo base_url('admin/estimate/delete/'.md5($estimate->id)) ?>">Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>

                                        <?php endif ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>


<?php foreach ($estimates as $estimate): ?>
<div id="sendEstimateModal_<?php echo html_escape($estimate->id) ?>" class="modal fade estimate_modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom modal-md">
        <form id="send-estimate-form" method="post" enctype="multipart/form-data" class="validate-form send-estimate-form" action="<?php echo base_url('admin/estimate/send')?>" role="form" novalidate>
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Send estimate <?php echo html_escape($estimate->id) ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 text-right control-label col-form-label">To</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email_to" value="<?php echo helper_get_customer($estimate->customer)->email ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 text-right control-label col-form-label">Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="message"> </textarea>
                        </div>
                    </div>

                    <div class="form-group row mt-10">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <input type="checkbox" id="md_checkbox_1" class="filled-in chk-col-blue" value="1" name="is_myself" aria-invalid="false">
                            <label for="md_checkbox_1"> Send a copy to myself at <b><?php echo user()->email ?></b></label>
                            <input type="hidden" class="form-control" value="<?php echo user()->email ?>" name="email_myself">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type="hidden" name="send_estimate_id" class="send_estimate_id" value="<?php echo md5($estimate->id) ?>">
                    <input type="hidden" name="customer_id" value="<?php echo html_escape($estimate->customer) ?>">
                    <button type="submit" class="btn btn-info rounded waves-effect pull-right submit_btn">Send</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php endforeach; ?>