<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="nav-tabs-custom">
      <?php include"include/profile_menu.php"; ?>
    </div>

    <?php $display = 'block'; ?>
    <?php if (check_package_limit('business') != 2 && $page_title != "Edit"): ?>
        <?php if ($total > check_package_limit('business')): ?>
            <?php $this->load->view("admin/user/include/package_limit_alert", ["limit_for" => "Business", "total" => $total]); ?>
            <?php $display = 'none'; ?>
        <?php endif ?>
    <?php endif ?>

    <div class="bus_area" style="display: <?php echo html_escape($display) ?>">
      <div class="col-md-8 box m-10 add_area" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?> ">
        <div class="box-header with-border">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <h3 class="box-title">Edit business</h3>
          <?php else: ?>
            <h3 class="box-title">Add New business </h3>
          <?php endif; ?>

          <div class="box-tools pull-right">
            <?php if (isset($page_title) && $page_title == "Edit"): ?>
              <a href="<?php echo base_url('admin/business') ?>" class="pull-right rounded btn btn-default btn-sm"><i class="fa fa-angle-left"></i> Back</a>
            <?php else: ?>
              <a href="#" class="text-right rounded btn btn-default btn-sm cancel_btn"><i class="fa fa-angle-left"></i> Back</a>
            <?php endif; ?>
          </div>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/business/add')?>" role="form" novalidate>

            <div class="form-group">
              <div class="avatar-uploadb text-center">
                    <div class="avatar-edit">
                        <input type='file' name="photo1" id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                        <?php if (isset($page_title) && $page_title == "Edit"): ?>
                          <div id="imagePreview" style="background-image: url(<?php echo base_url($busines[0]['logo']); ?>);">
                          </div>
                        <?php else: ?>
                          <div id="imagePreview">
                          <p class="upload-text"><i class="fa fa-plus"></i> <br> Upload Business logo</p>
                          </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label>Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="name" value="<?php echo html_escape($busines[0]['name']); ?>" >
            </div>

            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="title" value="<?php echo html_escape($busines[0]['title']); ?>" >
            </div>

            <div class="form-group">
              <label>Address</label>
              <textarea class="form-control" name="address"><?php echo html_escape($busines[0]['address']); ?></textarea>
            </div>

            <div class="form-group">
                <select class="selectfield textfield--grey single_select col-sm-12 single_select" name="category" required style="width: 100%">
                    <option value="">Select Business Type</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo html_escape($category->id); ?>" <?php if($category->id == $busines[0]['category']){echo "selected";} ?>>
                            <?php echo html_escape($category->name); ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <?php if (isset($page_title) && $page_title != "Edit"): ?>
            <div class="form-group">
                <select class="selectfield textfield--grey single_select col-sm-12 single_select" id="country" name="country" style="width: 100%">
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $country): ?>
                        <option value="<?php echo html_escape($country->id); ?>" <?php if($country->id == $busines[0]['country']){echo "selected";} ?>>
                            <?php echo html_escape($country->name); ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <?php endif; ?>

            <div class="form-group" id="currency">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <p><?php echo html_escape($busines[0]['currency_code']) ?> - <?php echo html_escape($busines[0]['currency_name']) ?> (<?php echo html_escape($busines[0]['currency_symbol']) ?>)</p>
                <?php endif; ?>
            </div>
            <p class="info callout callout-default">
                    This is your reporting currency and cannot be changed. You can still send invoices, track expenses and enter transactions in any currency and an exchange rate is applied for you.
                  </p>

            <input type="hidden" name="id" value="<?php echo html_escape($busines['0']['id']); ?>">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <div class="row mt-10">
              <div class="col-sm-12">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> Save Changes</button>
                <?php else: ?>
                  <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> Save business</button>
                <?php endif; ?>
              </div>
            </div>

          </form>
        </div>
      </div>


      <?php if (isset($page_title) && $page_title != "Edit"): ?>

      <div class="list_area container">
      
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit Business <a href="<?php echo base_url('admin/business') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a></h3>
        <?php else: ?>
          <h3 class="box-title">Business <a href="#" class="pull-right btn btn-info rounded btn-sm add_btn"><i class="fa fa-plus"></i> Add new Business</a></h3>
        <?php endif; ?>

          <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-20 p-0">
                <table class="table table-bordered table-hover <?php if(count($business) > 10){echo "datatable";} ?>" id="dg_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th>Informations</th>
                            <th></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($business as $busines): ?>
                        <tr id="row_<?php echo html_escape($busines->id); ?>">
                            
                            <td><?php echo $i; ?></td>
                            <td>
                              <?php if (!empty($busines->logo)): ?>
                              <img class="img-thumbnails min-w80 max-w80" src="<?php echo base_url($busines->logo); ?>">
                              <?php endif ?>
                            </td>
                            <td>
                              <h3 class="mt-0 mb-0"><?php echo html_escape($busines->name); ?></h3>
                              <p class="mb-0">Category: <strong><?php echo html_escape($busines->category_name) ?></strong></p>
                              <p class="mb-0"><?php echo html_escape($busines->currency_code.' - '.$busines->currency_name . ' (' .$busines->currency_symbol. ')'); ?></p>
                            </td>
                            <td class="text-center">
                              <?php if ($busines->is_primary == 1): ?>
                                <a href="#" class="btn btn-default" disabled data-toggle="tooltip" data-placement="top" title="This is your default business"><i class="fa fa-check text-success"></i> Default</a>
                              <?php else: ?>
                                <a data-val="<?php echo html_escape($busines->name); ?>" data-id="<?php echo html_escape($busines->id); ?>" href="<?php echo base_url('admin/business/set_primary/'.html_escape($busines->id));?>" class="btn btn-default primary_item" data-toggle="tooltip" data-placement="top" title="Set as a default business"><i class="fa fa-star text-warning"></i> Set Default</a>
                              <?php endif ?>
                            </td>

                            <td class="actions" width="5%">
                              <a href="<?php echo base_url('admin/business/edit/'.html_escape($busines->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                        
                      <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>


      </div>
      <?php endif; ?>
    </div>

  </section>
</div>