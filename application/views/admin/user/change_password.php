<div class="content-wrapper">
  <section class="content container">
    
      <div class="nav-tabs-custom">
        
          <?php include"include/profile_menu.php"; ?>

          <div class="row m-5 mt-20">
            <div class="col-md-8 box">
              
              <div class="box-header">
                  <h3 class="box-title">Change Password</h3>
              </div>

              <div class="box-body p-10">

                  <form method="post" id="cahage_pass_form" action="<?php echo base_url('admin/profile/change') ?>">

                    <div class="col-md-12 mt-20">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" class="form-control" name="old_pass" />
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="new_pass" />
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control" name="confirm_pass" />
                          </div>
                        </div>
                        
                      </div>
                    </div>

                  </form>

              </div>

              <div class="box-footer">
                  <!-- csrf token -->
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                  <button type="submit" class="btn btn-info waves-effect rounded w-md waves-light"><i class="fa fa-check"></i> Change</button>
              </div>

            </div>
          </div>
      </div>

  </section>
</div>