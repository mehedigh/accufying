
<!-- Start content -->
<div class="content">
	<div class="container">

		<!-- breadcrumb -->
    <?php //include APPPATH.'views/admin/include/breadcrumb.php'; ?>

    <div class="row">
       
      <div class="col-md-4 add_area">

          <?php if (isset($page_title) && $page_title != "Edit"): ?>
          <div class="panel panel-default input_area">
              <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-check"></i> <?php echo trans('set-default-language') ?> </h3>
              </div>

              <div class="panel-body">
                  <form id="cat-form" method="post" class="validate-form" action="<?php echo base_url('admin/settings/set_language')?>" role="form">
                      <?php $settings = get_settings(); ?>
                      <div class="form-group">
                        <select class="form-control select2" name="language">
                          <?php foreach ($languages as $lng): ?>
                            <option value="<?php echo $lng->id; ?>" <?php echo ($settings->lang == $lng->id) ? 'selected' : ''; ?>><?php echo ucfirst($lng->name); ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>

                      <!-- csrf token -->
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                      <button type="submit" class="btn btn-info pull-left m-t-10"><?php echo trans('save') ?></button>
                      
                  </form>

              </div>
          </div>
          <?php endif; ?>


          <div class="panel panel-default input_area">
              <div class="panel-heading">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <h3 class="panel-title"><?php echo trans('edit-language') ?> <a href="<?php echo base_url('admin/language') ?>" class="pull-right btn btn-inverse btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
                <?php else: ?>
                  <h3 class="panel-title"><i class="fa fa-plus"></i> <?php echo trans('add-new-language') ?> </h3>
                <?php endif; ?>
              </div>

              <div class="panel-body">
                  <form id="cat-form" method="post" class="validate-form" action="<?php echo base_url('admin/language/add')?>" role="form">
                     
                      <div class="form-group">
                          <label><?php echo trans('language-name') ?> <span class="require-field">*</span></label>
                          <input type="text" placeholder="Example: English, Duch" class="form-control" required name="name" value="<?php echo html_escape($language[0]['name']); ?>">
                      </div>

                      <div class="form-group">
                          <label><?php echo trans('short-form') ?> <span class="require-field">*</span></label>
                          <input type="text" placeholder="Example: en, du" class="form-control" required name="short_name" value="<?php echo html_escape($language[0]['short_name']); ?>">
                      </div>

                      <div class="row m-t-20 m-b-10">
                          <div class="col-sm-12">
                            <label> <?php echo trans('text-direction') ?> </label>
                          </div>
                          <div class="col-sm-8 text-left m-t-5">
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio2" value="ltr" name="text_direction" <?php if($language[0]['text_direction'] == 0){echo "checked";} ?>>
                                <label for="inlineRadio2"> LTR </label>
                            </div>

                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="rtl" name="text_direction" <?php if($language[0]['text_direction'] == 1){echo "checked";} ?>>
                                <label for="inlineRadio1"> RTL </label>
                            </div>
                          </div>
                      </div>

                      <input type="hidden" name="id" value="<?php echo html_escape($language['0']['id']); ?>">
                      <input type="hidden" name="lang_name" value="<?php echo html_escape($language['0']['name']); ?>">

                      <!-- csrf token -->
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                      <?php if (isset($page_title) && $page_title == "Edit"): ?>
                        <button type="submit" class="btn btn-info pull-left m-t-10"><?php echo trans('save-changes') ?></button>
                      <?php else: ?>
                        <button type="submit" class="btn btn-info pull-left m-t-10"><?php echo trans('save') ?></button>
                      <?php endif; ?>
                      
                  </form>

              </div>
          </div>
      </div>


    <?php if (isset($page_title) && $page_title != "Edit"): ?>

      <div class="col-md-8 list_area">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-bars"></i> <?php echo trans('all-language') ?> </h3>
              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 scroll">
                          <table class="table table-bordered datatable">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th><?php echo trans('name') ?></th>
                                      <th><?php echo trans('short-form') ?></th>
                                      <th><?php echo trans('direction') ?></th>
                                      <th><?php echo trans('status') ?></th>
                                      <th></th>
                                      <th><?php echo trans('action') ?></th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php $i=1; foreach ($languages as $lang): ?>
                                  <tr id="row_<?php echo html_escape($lang->id); ?>">
                                      
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo ucfirst(html_escape($lang->name)); ?></td>
                                      <td>
                                          <span class="label label-inverse"><?php echo html_escape($lang->short_name); ?></span>
                                      </td>
                                      <td>
                                          <?php if ($lang->text_direction == 'rtl'): ?>
                                            <span class="label label-danger"><?php echo strtoupper($lang->text_direction); ?></span>
                                          <?php else: ?>
                                            <span class="label label-primary"><?php echo strtoupper($lang->text_direction); ?></span>
                                          <?php endif ?>
                                      </td>
                                      
                                      <td>
                                        <?php if ($lang->status == 1): ?>
                                          <span class="label label-info">Active</span>
                                        <?php else: ?>
                                          <span class="label label-danger">Inactive</span>
                                        <?php endif ?>
                                      </td>

                                      <td>
                                          <a href="<?php echo base_url('admin/language/values/'.html_escape($lang->slug)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> <?php echo trans('edit-values') ?></a>
                                      </td>

                                      <td class="actions" width="15%">
                                        
                                        <a href="<?php echo base_url('admin/language/edit/'.html_escape($lang->id));?>" class="btn btn-default btn-sm btn-circle on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                                        <a data-val="Language" data-id="<?php echo html_escape($lang->id); ?>" href="<?php echo base_url('admin/language/delete/'.html_escape($lang->id));?>" class="btn btn-default btn-sm btn-circle on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

                                        <?php if ($lang->status == 1): ?>
                                          <a href="<?php echo base_url('admin/language/deactive/'.html_escape($lang->id));?>" class="btn btn-default btn-sm btn-circle on-default deactive-row" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-times"></i></a> &nbsp;
                                        <?php else: ?>
                                          <a href="<?php echo base_url('admin/language/active/'.html_escape($lang->id));?>" class="btn btn-default btn-sm btn-circle on-default active-row" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-check-circle"></i></a>
                                        <?php endif ?>

                                      </td>
                                  </tr>
                                <?php $i++; endforeach; ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>

    <?php endif; ?>

    </div>

  </div>
</div>
