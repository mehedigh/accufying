<div class="content-wrapper">
  <?php $settings = get_settings(); ?>
  <!-- Main content -->
  <section class="content">
    <div class="container">
        <div class="col-md-10 m-auto">

            <?php if (empty($this->business->logo)): ?>
                <?php include'include/setup_alert.php'; ?>
            <?php endif ?>
      
            <?php $display = 'block'; ?>
            <?php if (check_package_limit('invoice') != 2): ?>
                <?php if (isset($total) && $total > check_package_limit('invoice')): ?>
                    <?php $this->load->view("admin/user/include/package_limit_alert", ["limit_for" => "Invoices", "total" => $total]); ?>
                    <?php $display = 'none'; ?>
                <?php endif ?>
            <?php endif ?>

            <form id="invoice_form" method="post" enctype="multipart/form-data" class="validate-form leave_con" action="<?php echo base_url('admin/invoice/preview')?>" role="form" novalidate style="display: <?php echo html_escape($display) ?>">

                <?php include'include/invoice_header.php'; ?>
                
                <input type="hidden" class="add_val" name="add_val" value="">

                <div class="alert alert-danger mb-20 error_area" style="display: none;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <h4>Oops! There was an issue with your invoice. Please try again.</h4>
                  <div id="load_error"></div>
                </div>
               
                <!-- load preview data -->
                <div id="load_data"> </div>
                
                <div class="invoice_area mt-20">

                    <!-- invoice header -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default inv">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                    <div class="panel-heading inv" role="tab" id="heading8">
                                      <h4 class="panel-title inv">
                                         <span class="style_border">Business address and contact details, title, summary, and logo</span>
                                         <i class="fa fa-angle-down pull-right"></i>
                                      </h4>
                                    </div>
                                </a>
                                <div id="collapse8" class="panel-collapse data_collaps_border collapse" role="tabpanel" aria-labelledby="heading8" aria-expanded="false" style="height: 1px;">
                                  <div class="panel-body inv">                      
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img width="130px" src="<?php echo base_url($this->business->logo) ?>" alt="Logo">
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($page_title) && $page_title == 'Edit Invoice'): ?>
                                                <input type="text" id="example-input-large" name="title" class="form-control form-control-lg text-right" placeholder="Invoice title" value="Invoice <?php echo html_escape($invoice[0]['number']) ?>">
                                            <?php else: ?>
                                                <input type="text" class="form-control text-right" name="title" value="Invoice <?php echo get_invoice_number(1); ?>">
                                            <?php endif ?>
                                            <input type="text" id="example-input-large" name="summary" class="form-control form-control-md text-right" placeholder="Summary example: project name, description of invoice">

                                            <p class="mb-0 pull-right"><strong><?php echo html_escape($this->business->name) ?></strong></p><br>
                                            <p class="pull-right"><?php echo html_escape($this->business->country) ?></p>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- invoice body -->
                    <div class="box">

                      <div class="box-body inv">
                        <div class="container">

                            <div class="row mb-20">
                                
                                <div class="col-xs-12 col-md-12">
                                    
                                    <div class="row inv-info">
                                        <div class="col-xs-6 col-md-4 text-left">
                                            <h5>Bill to</h5>
                                            <select class="form-control single_select" name="customer" id="customer">
                                                <option value="">Add a customer</option>
                                                <?php foreach ($customers as $customer): ?>
                                                  <option value="<?php echo html_escape($customer->id) ?>" <?php echo($invoice[0]['customer'] == $customer->id) ? 'selected' : ''; ?>
                                                  ><?php echo html_escape($customer->name) ?></option>
                                                <?php endforeach ?>
                                            </select>

                                            <div class="mt-20" id="load_info"></div>
                                        </div>

                                        <div class="col-xs-6 col-md-8 text-right">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label">Invoice number</label>
                                                <div class="col-sm-4">
                                                    <?php if (isset($page_title) && $page_title == 'Edit Invoice'): ?>
                                                        <input type="text" class="form-control" name="number" value="<?php echo html_escape($invoice[0]['number']) ?>" placeholder="Invoice number">
                                                    <?php else: ?>
                                                        <input type="text" class="form-control" name="number" value="<?php echo get_invoice_number(1); ?>" placeholder="Invoice number">
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label">P.O./S.O. number</label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="<?php echo html_escape($invoice[0]['poso_number']) ?>" class="form-control" name="poso_number">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label">Invoice date</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker" placeholder="yyyy/mm/dd" name="date" value="<?php echo date('Y-m-d') ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calender"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mt-10">
                                                <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label">Payment due</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker" placeholder="yyyy/mm/dd" name="payment_due" value="<?php echo date('Y-m-d') ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calender"></i>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <select class="form-control mt-5" name="due_limit">
                                                        <option value="1">On Receipt</option>
                                                        <option value="15">Within 15 days</option>
                                                        <option value="30">Within 30 days</option>
                                                        <option value="45">Within 45 days</option>
                                                        <option value="60">Within 60 days</option>
                                                        <option value="75">Within 75 days</option>
                                                        <option value="90">Within 90 days</option>
                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr class="item-row">
                                                    <th>Item</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            <?php if (isset($page_title) && $page_title == 'Edit Invoice'): ?>
                                                <?php $items = helper_get_invoice_items($invoice[0]['id']) ?>
                                                <?php foreach ($items as $product): ?>
                                                    <tr class="item-row">
                                                        <td>
                                                            <input type="text" class="form-control item" placeholder="Item" type="text" name="items_val[]" value="<?php echo html_escape($product->item_name) ?>">  
                                                             <input type="hidden" class="form-control item" placeholder="Item" type="text" name="items[]" value="<?php echo html_escape($product->item) ?>">
                                                        </td>
                                                        <td>
                                                            <input class="form-control price invo" placeholder="Price" type="text" name="price[]" value="<?php echo html_escape($product->price) ?>"> 
                                                        </td>
                                                        <td>
                                                            <input class="form-control qty" placeholder="Quantity" type="text" name="quantity[]" value="<?php echo html_escape($product->qty) ?>">
                                                        </td>
                                                        <td width="15%">
                                                            <div class="delete-btn">
                                                                <span class="currency_wrapper"></span>
                                                                <span class="total"><?php echo html_escape($product->price) ?></span>
                                                                <a class="delete" href="javascript:;" title="Remove row">&times;</a>
                                                                <input type="hidden" name="total_price[]" value="<?php echo html_escape($product->price) ?>">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>


                                            <thead id="add_item">
                                                
                                            </thead>
                                            

                                            <tr>
                                                <td colspan="4" class="p-0">
                                                <a href="#" class="btn btn-default add_item_btn"><i class="icon-plus"></i> Add an item</a>
                                                </td>
                                            </tr>

                                            <tr id="products_list_inv" style="display: none;">
                                                <td colspan="4" class="p-0">
                                                    <div class="inv-product br-10 dshadow">
                                                        <div class="form-group has-search">
                                                            <span class="icon-magnifier form-control-feedback"></span>
                                                            <input type="text" class="form-control search_product" placeholder="Type product">
                                                        </div>

                                                        <div class="loaderp text-center p-10"></div>

                                                        <!-- load ajax data -->
                                                        <div id="load_product">
                                                            <?php include'include/invoice_product_list.php'; ?>
                                                        </div>

                                                        <div class="col-md-12 p-0 text-center">
                                                            <a data-toggle="modal" href="#productModal" title="Add a row" class="add-new-item btn btn-block btn-info p-10"><i class="icon-plus"></i> Add new item</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><strong>Sub Total</strong></td>
                                                <td>
                                                    <span class="currency_wrapper"></span>
                                                    <span id="subtotal">0.00</span> 
                                                    <input type="hidden" class="subtotal" name="sub_total" value="">
                                                </td>
                                            </tr>
                                                       
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><strong>Tax</strong></td>
                                                <td width="20%">
                                                    <select class="form-control" id="tax" name="tax">
                                                        <option value="0">Select tax</option>
                                                        <?php foreach ($taxes as $tax): ?>
                                                          <option value="<?php echo html_escape($tax->rate) ?>"><?php echo html_escape($tax->name) ?> - <?php echo html_escape($tax->rate) ?>%</option>
                                                        <?php endforeach ?>
                                                    </select>    
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><strong>Discount</strong></td>
                                                <td width="15%">
                                                    <div class="input-group">
                                                        <input type="text" id="discount" name="discount" value="0" class="form-control" aria-describedby="basic-addon2">
                                                        <div class="input-group-append discount">
                                                            <span class="input-group-text" id="basic-addon1">%</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><span class="currency_name mr-10"></span> <strong> Grand Total</strong></td>
                                                <td>
                                                    <span class="currency_wrapper"></span>
                                                    <span id="grandTotal">0</span>
                                                    <input type="hidden" class="grandtotal" name="grand_total" value="">
                                                    <input type="hidden" class="convert_total" name="convert_total" value="">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="box-footer text-right">
                        <input type="hidden" class="currency_code" name="currency_code" value="">
                        <strong><span class="conversion_currency"> </span></strong>
                      </div>
                    </div> 

                    <!-- invoice footer -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default inv">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    <div class="panel-heading inv" role="tab" id="heading8">
                                      <h4 class="panel-title inv">
                                         <span class="style_border">Footer</span>
                                         <i class="fa fa-angle-down pull-right fa-1x"></i>
                                      </h4>
                                    </div>
                                </a>
                                <div id="collapse2" class="panel-collapse data_collaps_border collapse" role="tabpanel" aria-labelledby="heading2" aria-expanded="false" style="height: 1px;">
                                  <div class="panel-body inv">                      
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea class="form-control" rows="4" name="footer_note" placeholder="Enter a footer for this invoice (e.g. tax information, thank you note)"></textarea>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-10">
                        <div class="col-md-12">
                            <div class="inv-top-btn mb-10">
                                <?php if (isset($page_title) && $page_title == 'Edit Invoice'): ?>
                                    <a href="<?php echo base_url('admin/invoice/details/'.md5($invoice[0]['id'])) ?>" class="btn btn-default btn-rounded pull-right ml-10"><i class="fa fa-long-arrow-left"></i> Back</a>
                                <?php endif ?>
                    
                              <button type="submit" class="btn btn-info btn-rounded save_invoice_btn pull-right ml-5"><?php if(isset($page_title) && $page_title == 'Edit Invoice'){echo "Update";}else{echo "Save and continue";} ?></button>
                                
                              <button id="edit_invoice" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info pull-right mr-10 edit_invoice_btn" style="display: none;">Edit</button>
                                <button type="submit" class="btn waves-effect waves-light btn-outline-info btn-rounded pull-right mr-10 preview_invoice_btn">Preview</button>
                            </div>
                            <input type="hidden" class="set_value" name="check_value">
                        </div>
                    </div>

                </div>

                <!-- csrf token -->
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <input type="hidden" name="id" value="<?php echo html_escape($invoice[0]['id']); ?>">
                <input type="hidden" name="is_recurring" value="<?php echo html_escape($type); ?>">

            </form>

        </div>
    </div>
  </section>
</div>


<!-- product list modal -->
<div id="productModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-md">
        <form id="product-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/invoice/ajax_add_product')?>" role="form" novalidate>
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Add new product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label">Product name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label">Price</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="price" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label">Details</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="details"> </textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button type="submit" class="btn btn-info waves-effect pull-right">Add Product</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
        