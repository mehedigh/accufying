<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

      <div class="col-md-6 m-auto box add_area" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
        <div class="box-header with-border">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <h3 class="box-title">Edit tax</h3>
          <?php else: ?>
            <h3 class="box-title">Add new tax </h3>
          <?php endif; ?>

          <div class="box-tools pull-right">
            <?php if (isset($page_title) && $page_title == "Edit"): ?>
              <a href="<?php echo base_url('admin/tax') ?>" class="pull-right rounded btn btn-default btn-sm"><i class="fa fa-angle-left"></i> Back</a>
            <?php else: ?>
              <a href="#" class="text-right btn btn-default rounded btn-sm cancel_btn"><i class="fa fa-angle-left"></i> Back</a>
            <?php endif; ?>
          </div>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/tax/add')?>" role="form" novalidate>

            <div class="form-group">
              <label>Tax Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="name" value="<?php echo html_escape($tax[0]['name']); ?>" >
            </div>

            <div class="form-group">
              <label>Tax Rate (%)<span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="rate" value="<?php echo html_escape($tax[0]['rate']); ?>">
              <p>Tax rate should be a number only, without a percent sign.</p>
            </div>

            <div class="form-group">
              <label>Tax Number / ID</label>
              <input type="text" class="form-control" required name="number" value="<?php echo html_escape($tax[0]['number']); ?>" >
            </div>

            <div class="form-group">
              <label>Details</label>
              <textarea class="form-control" name="details" rows="6"><?php echo html_escape($tax[0]['details']); ?></textarea>
            </div>

            <div class="form-group m-t-30">
                <input type="checkbox" id="md_checkbox_1" class="filled-in chk-col-blue" value="1" name="is_invoices">
                <label for="md_checkbox_1"> Show tax number on invoices</label>
            </div>

            <input type="hidden" name="id" value="<?php echo html_escape($tax['0']['id']); ?>">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <hr>

            <div class="row m-t-30">
              <div class="col-sm-12">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> Save changes</button>
                <?php else: ?>
                  <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> Save tax</button>
                <?php endif; ?>
              </div>
            </div>

          </form>

        </div>
      </div>


      <?php if (isset($page_title) && $page_title != "Edit"): ?>
        <div class="list_area container">

          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <h3 class="box-title">Edit tax <a href="<?php echo base_url('admin/portfolio_tax') ?>" class="pull-right btn btn-default rounded btn-sm"><i class="fa fa-angle-left"></i> Back</a></h3>
          <?php else: ?>
            <h3 class="box-title">All tax <a href="#" class="pull-right btn btn-info rounded btn-sm add_btn"><i class="fa fa-plus"></i> Add new tax</a></h3>
          <?php endif; ?>

            
          <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-20 p-0">
              <table class="table table-bordered table-hover  <?php if(count($taxes) > 10){echo "datatable";} ?>" id="dg_table">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Rate</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; foreach ($taxes as $tax): ?>
                      <tr id="row_<?php echo html_escape($tax->id); ?>">
                          
                          <td><?php echo $i; ?></td>
                          <td><?php echo html_escape($tax->name); ?></td>
                          <td><?php echo html_escape($tax->rate); ?> %</td>
                          

                          <td class="actions" width="15%">
                            <a href="<?php echo base_url('admin/tax/edit/'.html_escape($tax->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                            <a data-val="tax" data-id="<?php echo html_escape($tax->id); ?>" href="<?php echo base_url('admin/portfolio_tax/delete/'.html_escape($tax->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
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
