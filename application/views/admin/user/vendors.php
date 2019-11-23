<div class="content-wrapper">

  <!-- Main content -->
  <section class="content ">

      <div class="col-md-6 m-auto box add_area mt-50" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">

          <div class="box-header">
            <?php if (isset($page_title) && $page_title == "Edit"): ?>
              <h3>Edit vendor <a href="<?php echo base_url('admin/vendor') ?>" class="pull-right btn btn-default rounded btn-sm"><i class="fa fa-angle-left"></i> Back</a></h3>
            <?php else: ?>
              <h3>Add new vendor <a href="#" class="pull-right btn btn-default btn-sm rounded cancel_btn"><i class="fa fa-angle-left"></i> Back</a></h3>
            <?php endif; ?>
          </div>
  
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form mt-20 p-30" action="<?php echo base_url('admin/vendor/add')?>" role="form" novalidate>

            <div class="form-group">
              <label>Vendor Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="name" value="<?php echo html_escape($vendor[0]['name']); ?>" >
            </div>

            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" name="phone" value="<?php echo html_escape($vendor[0]['phone']); ?>" >
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="email" value="<?php echo html_escape($vendor[0]['email']); ?>" >
            </div>

            <div class="form-group">
              <label>Address</label>
              <textarea class="form-control" name="address"><?php echo html_escape($vendor[0]['address']); ?></textarea>
            </div>
            

            <input type="hidden" name="id" value="<?php echo html_escape($vendor['0']['id']); ?>">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <hr>

            <div class="row m-t-30">
              <div class="col-sm-12">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <button type="submit" class="btn btn-info btn-rounded pull-left"><i class="fa fa-check"></i> Save Changes</button>
                <?php else: ?>
                  <button type="submit" class="btn btn-info btn-rounded pull-left"><i class="fa fa-check"></i> Save Vendor</button>
                <?php endif; ?>
              </div>
            </div>

          </form>

      </div>


      <?php if (isset($page_title) && $page_title != "Edit"): ?>
        <div class="list_area container">
          
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <h3 class="box-title">Edit vendor <a href="<?php echo base_url('admin/vendor') ?>" class="pull-right btn btn-primary rounded btn-sm"><i class="fa fa-angle-left"></i> Back</a></h3>
          <?php else: ?>
            <h3 class="box-title">Vendors <a href="#" class="pull-right btn btn-info btn-sm rounded add_btn"><i class="fa fa-plus"></i> Add new vendor</a></h3>
          <?php endif; ?>

          <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-20 p-0">
              <table class="table table-bordered table-hover <?php if(count($vendors) > 10){echo "datatable";} ?>" id="dg_table">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; foreach ($vendors as $vendor): ?>
                      <tr id="row_<?php echo html_escape($vendor->id); ?>">
                          
                          <td><?php echo $i; ?></td>
                          <td><?php echo html_escape($vendor->name); ?></td>
                          <td><?php echo html_escape($vendor->phone); ?></td>
                          <td><?php echo html_escape($vendor->email); ?></td>

                          <td class="actions" width="15%">
                            <a href="<?php echo base_url('admin/vendor/edit/'.html_escape($vendor->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                            <a data-val="vendor" data-id="<?php echo html_escape($vendor->id); ?>" href="<?php echo base_url('admin/vendor/delete/'.html_escape($vendor->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
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
