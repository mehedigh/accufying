<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="col-md-6 m-auto box add_area" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit customer</h3>
        <?php else: ?>
          <h3 class="box-title">Add New Customer </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <a href="<?php echo base_url('admin/customer') ?>" class="pull-right rounded btn btn-default btn-sm"><i class="fa fa-angle-left"></i> Back</a>
          <?php else: ?>
            <a href="#" class="text-right rounded btn btn-default btn-sm cancel_btn"><i class="fa fa-angle-left"></i> Back</a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/customer/add')?>" role="form" novalidate>

          <div class="form-group">
            <label>Customer Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="name" value="<?php echo html_escape($customer[0]['name']); ?>" >
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo html_escape($customer[0]['email']); ?>" >
          </div>

          <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" name="phone" value="<?php echo html_escape($customer[0]['phone']); ?>" >
          </div>

          <div class="form-group">
            <label>Address </label>
            <textarea class="form-control" name="address"><?php echo html_escape($customer[0]['address']); ?></textarea>
          </div>
          <hr>

          <h4>Billing Information</h4><br>

          <div class="form-group">
              <label class="col-sm-2 control-label p-0" for="example-input-normal">Country </label>
              <select class="form-control single_select col-sm-12" id="country" name="country" style="width: 100%">
                  <option value="">Select</option>
                  <?php foreach ($countries as $country): ?>
                      <?php if (!empty($country->currency_name)): ?>
                        <option value="<?php echo html_escape($country->id); ?>" 
                          <?php echo ($customer[0]['country'] == $country->id) ? 'selected' : ''; ?>>
                          <?php echo html_escape($country->name); ?>
                        </option>
                      <?php endif ?>
                  <?php endforeach ?>
              </select>
          </div>

          <div class="form-group">
              <label class="col-sm-2 control-label p-0" for="example-input-normal">Currency </label>
              <select class="form-control col-sm-12 wd-100" id="currency" name="currency" disabled>
                  <option value="">Select</option>
                  <?php foreach ($countries as $currency): ?>
                      <option <?php echo ($customer[0]['currency'] == $currency->currency_code) ? 'selected' : ''; ?>>
                        <?php echo html_escape($currency->currency_code.' - '.$currency->currency_name); ?>
                      </option>
                  <?php endforeach ?>
              </select>
          </div>
          
          <div class="form-group">
            <label>City</label>
            <input type="text" class="form-control" name="city" value="<?php echo html_escape($customer[0]['city']); ?>" >
          </div>

          <div class="form-group">
            <label>Postal / Zip code</label>
            <input type="text" class="form-control" name="postal_code" value="<?php echo html_escape($customer[0]['postal_code']); ?>" >
          </div>

          <div class="form-group">
            <label>Address 1</label>
            <textarea class="form-control" name="address1"><?php echo html_escape($customer[0]['address1']); ?></textarea>
          </div>

          <div class="form-group">
            <label>Address 2</label>
            <textarea class="form-control" name="address2"><?php echo html_escape($customer[0]['address2']); ?></textarea>
          </div>


          <input type="hidden" name="id" value="<?php echo html_escape($customer['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <hr>

          <div class="row m-t-30">
            <div class="col-sm-12">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> Save Changes</button>
              <?php else: ?>
                <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> Save Customer</button>
              <?php endif; ?>
            </div>
          </div>

        </form>
      </div>

      <div class="box-footer">

      </div>
    </div>


    <?php if (isset($page_title) && $page_title != "Edit"): ?>

      <?php $display = 'block'; ?>
        <?php if (check_package_limit('customer') != 2): ?>
            <?php if (count($customers) > check_package_limit('customer')): ?>
                <?php $this->load->view("admin/user/include/package_limit_alert", ["limit_for" => "Customers", "total" => count($customers)]); ?>
                <?php $display = 'none'; ?>
            <?php endif ?>
        <?php endif ?>

      <div class="list_area container" style="display: <?php echo html_escape($display) ?>">
      
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit customer <a href="<?php echo base_url('admin/customer') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a></h3>
        <?php else: ?>
          <h3 class="box-title">All customers <a href="#" class="pull-right btn btn-info rounded btn-sm add_btn"><i class="fa fa-plus"></i> Add new customer</a></h3>
        <?php endif; ?>

        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-20 p-0">
            <table class="table table-hover <?php if(count($customers) > 10){echo "datatable";} ?>">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Info</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($customers as $customer): ?>
                    <tr id="row_<?php echo html_escape($customer->id); ?>">
                        
                        <td><?php echo $i; ?></td>
                        <td><strong><?php echo html_escape($customer->name); ?></strong></td>
                        <td>
                          <p class="mb-0"><?php echo html_escape($customer->country_name); ?></p>
                          <p class="mb-0 fs-12"><?php echo html_escape($customer->currency_code . ' - ' . $customer->currency_name . ' (' .$customer->currency_symbol .')'); ?></p>
                        </td>
                        <td><?php echo html_escape($customer->email); ?></td>
                        <td><?php echo html_escape($customer->phone); ?></td>
                        <td><?php echo my_date_show($customer->created_at); ?></td>
                        
                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/customer/edit/'.html_escape($customer->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="Category" data-id="<?php echo html_escape($customer->id); ?>" href="<?php echo base_url('admin/customer/delete/'.html_escape($customer->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;
                        </td>
                    </tr>
                    
                  <?php $i++; endforeach; ?>
                </tbody>
            </table>
        </div>

      </div>
    <?php endif; ?>

  </section>
</div>
