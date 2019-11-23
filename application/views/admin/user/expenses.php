<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

      <div class="col-md-5 m-auto box add_area mt-50" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
          
          <div class="box-header with-border">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <h3 class="box-title">Edit Expense </h3>
              <?php else: ?>
                <h3 class="box-title">Add new Expense</h3>
              <?php endif; ?>

            <div class="box-tools pull-right">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <a href="<?php echo base_url('admin/expense') ?>" class="btn btn-default rounded btn-sm"><i class="fa fa-angle-left"></i> Back</a>
              <?php else: ?>
                <a href="#" class="btn btn-default btn-sm rounded cancel_btn"><i class="fa fa-angle-left"></i> Back</a>
              <?php endif; ?>
            </div>
          </div>

          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form mt-20 p-30" action="<?php echo base_url('admin/expense/add')?>" role="form" novalidate>

            <div class="form-group">
              <label>Expense Amount <span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="amount" value="<?php echo html_escape($expense[0]['amount']); ?>" >
            </div>

            <div class="form-group">
                <label class="col-sm-12 control-label p-0" for="example-input-normal">Vendors </label>
                <select class="form-control" name="vendor">
                    <option value="0">Select</option>
                    <?php foreach ($vendors as $vendor): ?>
                        <option value="<?php echo html_escape($vendor->id); ?>" 
                          <?php echo ($expense[0]['vendor'] == $vendor->id) ? 'selected' : ''; ?>>
                          <?php echo html_escape($vendor->name); ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label class="col-sm-12 control-label p-0" for="example-input-normal">Expense Category <span class="text-danger">*</span></label>
                <select class="form-control" name="category" required>
                    <option value="0">Select</option>
                    <?php foreach ($expense_category as $category): ?>
                        <option value="<?php echo html_escape($category->id); ?>" 
                          <?php echo ($expense[0]['category'] == $category->id) ? 'selected' : ''; ?>>
                          <?php echo html_escape($category->name); ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-12 control-label p-0">Date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control datepicker" required placeholder="yyyy/mm/dd" name="date" value="<?php echo date('Y-m-d') ?>">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-calender"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label>Notes</label>
              <textarea class="form-control" name="notes"><?php echo html_escape($expense[0]['notes']); ?></textarea>
            </div>
            

            <input type="hidden" name="id" value="<?php echo html_escape($expense['0']['id']); ?>">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">


            <div class="row m-t-30">
              <div class="col-sm-12">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <button type="submit" class="btn btn-info btn-rounded pull-left"><i class="fa fa-check"></i> Save Changes</button>
                <?php else: ?>
                  <button type="submit" class="btn btn-info btn-rounded pull-left"><i class="fa fa-check"></i> Save Expense</button>
                <?php endif; ?>
              </div>
            </div>

          </form>
      </div>

      <?php if (isset($page_title) && $page_title != "Edit"): ?>
        <div class="list_area container">
          
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <h3 class="box-title">Edit expense <a href="<?php echo base_url('admin/expense') ?>" class="pull-right btn btn-primary rounded btn-sm"><i class="fa fa-angle-left"></i> Back</a></h3>
          <?php else: ?>
            <h3 class="box-title">Expenses <a href="#" class="pull-right btn btn-info btn-sm rounded add_btn"><i class="fa fa-plus"></i> Add new Expense</a></h3>
          <?php endif; ?>

          <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-20 p-0">
              <table class="table table-bordered table-hover <?php if(count($expenses) > 10){echo "datatable";} ?>" id="dg_table">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Client</th>
                          <th>Category</th>
                          <th>Notes</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; foreach ($expenses as $expense): ?>
                      <tr id="row_<?php echo html_escape($expense->id); ?>">
                          
                          <td><?php echo $i; ?></td>
                          <td><?php echo my_date_show($expense->date); ?></td>
                          <td><?php echo round($expense->amount); ?></td>
                          <td><?php echo html_escape($expense->vendor); ?></td>
                          <td><?php echo html_escape($expense->category); ?></td>
                          <td><?php echo html_escape($expense->notes); ?></td>

                          <td class="actions" width="15%">
                            <a href="<?php echo base_url('admin/expense/edit/'.html_escape($expense->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                            <a data-val="expense" data-id="<?php echo html_escape($expense->id); ?>" href="<?php echo base_url('admin/expense/delete/'.html_escape($expense->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
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
