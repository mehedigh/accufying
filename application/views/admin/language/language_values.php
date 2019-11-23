

<!-- Start content -->
<div class="content">
	<div class="container">

		<!-- breadcrumb -->
    <?php //include APPPATH.'views/admin/include/breadcrumb.php'; ?>

    <div class="row">

      <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><?php echo trans('add-language-values') ?></h3></div>
            <div class="panel-body">
                <form method="post" class="validate-form" action="<?php echo base_url('admin/language/add_value')?>" role="form" novalidate>
                    
                    <div class="col-md-4">
                      <label><?php echo trans('label') ?><span class="text-danger">*</span></label>
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Example: Home / Register User" name="label" required>
                      </div><br>
                    </div>

                    <div class="col-md-4">
                      <label><?php echo trans('keyword') ?><span class="text-danger">*</span></label>
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Example: home / register_user" name="keyword" required>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <label>Arabic<span class="text-danger">*</span></label>
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Example: home / register_user" name="arabic" required>
                      </div>
                    </div>

                    <input type="hidden" name="lang" value="<?php echo html_escape($value) ?>">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                    <div class="m-t-15">
                      <div class="col-sm-12">
                          <button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> <?php echo trans('save') ?></button>
                      </div>
                    </div>

                </form>
            </div>
        </div>
      </div>


      <div class="col-md-12 add_area">
        <div class="panel panel-default input_area">
          <div class="panel-heading">
    
            <h5 class="panel-title"><?php echo trans('update-language-for') ?> ( <?php echo ucfirst($value) ?> ) </h5>

            <div class="dropdown pull-<?php echo($settings->dir == 'rtl') ? 'left' : 'right'; ?>">
              <button type="button" class="btn btn-danger dropdown-toggle btn-sm" data-toggle="dropdown">
                <i class="fa fa-language"></i> <?php echo ucfirst($value); ?>  <i class="fa fa-angle-down"></i>              
              </button>
              <div class="dropdown-menu">
                <?php $lang_list = get_language(); ?>
                <?php foreach ($lang_list as $lg): ?>
                  <a class="dropdown-item" href="<?php echo base_url('admin/language/values/'.$lg->slug) ?>"><?php echo ucfirst($lg->name) ?></a>
                <?php endforeach ?>
              </div>
            </div>

            
          </div>
          <div class="panel-body">

          <form method="post" class="validate-form" action="<?php echo base_url('admin/language/update_values')?>" role="form" novalidate>

            <div class="row">
              <div class="col-sm-6">
                  <?php echo $this->pagination->create_links(); ?>
              </div>
              <div class="col-sm-6">
                  <button type="submit" class="btn btn-success pull-<?php echo($settings->dir == 'rtl') ? 'left' : 'right'; ?> m-t-20"><i class="fa fa-check"></i> <?php echo trans('save-changes') ?></button>
              </div>
            </div>

            <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr role="row">
                  <th>#</th>
                  <th><?php echo trans('label') ?></th>
                  <th><?php echo trans('keyword') ?></th>
                  <th><?php echo trans('value') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($language as $lang): ?>
                  <tr class="tr-phrase">
                    <td style="width: 50px;"><?php echo $i; ?></td>
                    <td style="width: 30%;"><input type="text" class="form-control bg-g" value="<?php echo html_escape($lang->label) ?>" readonly></td>
                    <td style="width: 15%;"><input type="text" class="form-control bg-g" value="<?php echo html_escape($lang->keyword) ?>" readonly></td>
                    <td style="width: 65%;" <?php if($value == 'arabic'){echo "dir='rtl'";} ?>><input type="text" name="value<?php echo html_escape($lang->id) ?>" class="form-control" value="<?php echo html_escape($lang->$value) ?>"></td>
                  </tr>
                <?php $i++; endforeach ?>

              </tbody>
            </table>

            <input type="hidden" name="lang_type" value="<?php echo html_escape($value) ?>">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <div class="row">
              <div class="col-sm-6">
                  <?php echo $this->pagination->create_links(); ?>
              </div>
              <div class="col-sm-6">
                  <button type="submit" class="btn btn-success pull-<?php echo($settings->dir == 'rtl') ? 'left' : 'right'; ?> m-t-20"><i class="fa fa-check"></i><?php echo trans('save-changes') ?></button>
              </div>
            </div>

          </form>

          </div>
        </div>
      </div>


      
    </div>

  </div>
</div>
