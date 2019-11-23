<div class="content-wrapper">

   <section class="content">
      
      <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/update') ?>" role="form" class="form-horizontal">

        <div class="nav-tabs-custom">
            
            <ul class="nav nav-tabs admin">
              <li><a class="active" href="#content1" data-toggle="tab"><i class="fa fa-cog"></i> General Settings</a></li>
              <li><a href="#content2" data-toggle="tab"><i class="fa fa-envelope"></i> Email Settings</a></li>
              <li><a href="#content3" data-toggle="tab"><i class="fa fa-cog"></i> reCaptcha Settings</a></li>
              <li><a href="#content4" data-toggle="tab"><i class="fa fa-dollar"></i> Payment Settings</a></li>
              <li><a href="#content5" data-toggle="tab"><i class="fa fa-cog"></i> Social Settings</a></li>
            </ul>

            <div class="row mt-20">
              <div class="col-md-8">
                <div class="tab-content box">

          
                    <div class="box-header">
                      <h3 class="box-title">Update Settings</h3>
                    </div>

             
                    <!-- tab 1 -->
                    <div class="active tab-pane" id="content1">
                
                        <div class="box-body">

                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <div class="col-sm-12">
                                      <img width="20px" src="<?php echo base_url($settings->favicon); ?>">
                                      <div style="position:relative;" class="m-t-5">
                                          <a class='btn btn-default' href='javascript:;'>
                                              <i class="fa fa-cloud-upload"></i> Upload favicon
                                              <input type="file" style='position:absolute;z-index:2;top:0;left:0;height:38px;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="photo1" size="40"  onchange='$("#upload-favicon").html($(this).val());'>
                                          </a>
                                          &nbsp;
                                          <span class='label label-default' id="upload-favicon"></span>
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                  
                                  <div class="col-sm-12">
                                      <img width="100px" src="<?php echo base_url($settings->logo); ?>">
                                      <div style="position:relative;" class="m-t-5">
                                          <a class='btn btn-default' href='javascript:;'>
                                              <i class="fa fa-cloud-upload"></i> Upload logo
                                              <input type="file" style='position:absolute;z-index:2;top:0;left:0;height:38px;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="photo2" size="40"  onchange='$("#upload-logo").html($(this).val());'>
                                          </a>
                                          &nbsp;
                                          <span class='label label-default' id="upload-logo"></span>
                                      </div>
                                  </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-group m-t-20">
                              <label class="col-sm-2 control-label" for="example-input-normal">Application  Name</label>
                              <div class="col-sm-12">
                                  <input type="text" name="site_name" value="<?php echo html_escape($settings->site_name); ?>" class="form-control" >
                              </div>
                          </div>

                          <div class="form-group m-t-20">
                              <label class="col-sm-2 control-label" for="example-input-normal">Application  Title</label>
                              <div class="col-sm-12">
                                  <input type="text" name="site_title" value="<?php echo html_escape($settings->site_title); ?>" class="form-control" >
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label" for="example-input-normal">Keywords</label>
                              <div class="col-sm-12">
                                  <input type="text" data-role="tagsinput" name="keywords" value="<?php echo html_escape($settings->keywords); ?>" class="form-control" >
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label" for="example-input-normal">Description</label>
                              <div class="col-sm-12">
                                  <textarea class="form-control" name="description" rows="4"><?php echo html_escape($settings->description); ?></textarea>
                              </div>
                          </div>
                          

                          <div class="form-group">
                              <label class="col-sm-2 control-label" for="example-input-normal">Footer About</label>
                              <div class="col-sm-12">
                                  <textarea class="form-control" name="footer_about"><?php echo html_escape($settings->footer_about); ?></textarea>
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 control-label" for="example-input-normal">Admin Email</label>
                              <div class="col-sm-12">
                                  <input type="email" name="admin_email" class="form-control" value="<?php echo html_escape($settings->admin_email); ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label" for="example-input-normal">Copyright</label>
                              <div class="col-sm-12">
                                  <input type="text" name="copyright" class="form-control" value="<?php echo html_escape($settings->copyright); ?>">
                              </div>
                          </div>

                          <!-- <div class="form-group m-b-20">
                              <label class="col-sm-2 control-label" for="example-input-normal"> Pagination Limit</label>
                              <div class="col-sm-12">
                                <input type="number" name="pagination_limit" class="form-control" value="<?php //echo html_escape($settings->pagination_limit); ?>">
                                  
                              </div>
                          </div> -->
                        </div>
                  
                    </div>

                    <!-- tab 2 -->
                    <div class="tab-pane" id="content2" aria-hidden="false">
                      <div class="box-body">
                        <div class="callout callout-default">
                            <h4><i class="icon-info"></i> Gmail Smtp</h4>

                            <p>Gmail host:&nbsp;&nbsp;smtp.gmail.com</br>
                            Gmail port:&nbsp;&nbsp;465</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Mail Protocol</label>

                            <select name="mail_protocol" class="form-control custom-select">
                                <option value="smtp" <?php echo ($settings->mail_protocol == "smtp") ? "selected" : ""; ?>>smtp</option>
                                <option value="mail" <?php echo ($settings->mail_protocol == "mail") ? "selected" : ""; ?>>mail</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Mail title</label>
                            <input type="text" class="form-control" name="mail_title"
                                   value="<?php echo html_escape($settings->mail_title); ?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Mail host</label>
                            <input type="text" class="form-control" name="mail_host"
                                   value="<?php echo html_escape($settings->mail_host); ?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Mail port</label>
                            <input type="text" class="form-control" name="mail_port"
                                    value="<?php echo html_escape($settings->mail_port); ?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Mail username</label>
                            <input type="text" class="form-control" name="mail_username"
                                    value="<?php echo html_escape($settings->mail_username); ?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Mail password</label>
                            <input type="password" class="form-control" name="mail_password"
                                    value="<?php echo html_escape($settings->mail_password); ?>">
                        </div>
                      </div>
                    </div>

                    <!-- tab 3 -->
                    <div class="tab-pane" id="content3" aria-hidden="false">
                      <div class="box-body">
                        <div class="form-group m-t-20">
                            <label class="col-sm-2 control-label" for="example-input-normal">Captcha Site key</label>
                            <div class="col-sm-12">
                                <input type="text" name="captcha_site_key" value="<?php echo html_escape($settings->captcha_site_key); ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group m-t-20">
                            <label class="col-sm-2 control-label" for="example-input-normal">Captcha Secret key</label>
                            <div class="col-sm-12">
                                <input type="text" name="captcha_secret_key" value="<?php echo html_escape($settings->captcha_secret_key); ?>" class="form-control" >
                            </div>
                        </div>
                      </div>
                    </div>

                    <!-- tab 4 -->
                    <div class="tab-pane" id="content4" aria-hidden="false">
                      <div class="box-body">

                        <div class="form-group mt-20">
                            <label class="col-sm-4 control-label" for="example-input-normal">Currency </label>
                            <div class="col-sm-12">
                              <select class="form-control single_select" id="currency" name="currency" style="width: 100%">
                                  <option value="">Select</option>
                                  <?php foreach ($currencies as $currency): ?>
                                      <?php if (!empty($currency->currency_name)): ?>
                                        <option value="<?php echo html_escape($currency->currency_code); ?>" 
                                          <?php echo ($settings->currency == $currency->currency_code) ? 'selected' : ''; ?>>
                                          <?php echo html_escape($currency->currency_name.' - '.$currency->currency_code.' ('.$currency->currency_symbol.')'); ?>
                                        </option>
                                      <?php endif ?>
                                  <?php endforeach ?>
                              </select>
                            </div>
                        </div>

                        <div class="form-group mt-20">
                            <label class="col-sm-4 control-label" for="example-input-normal">Paypal Mode </label>
                            <div class="col-sm-12">
                              <select class="form-control" name="paypal_mode" style="width: 100%">
                                  <option value="">Select</option>
                                    <option value="sandbox" <?php echo ($settings->paypal_mode == 'sandbox') ? 'selected' : ''; ?>>Sandbox</option>
                                    <option value="live" <?php echo ($settings->paypal_mode == 'live') ? 'selected' : ''; ?>>Live</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="example-input-normal">Paypal Merchant Account</label>
                            <div class="col-sm-12">
                                <input type="text" name="paypal_email" value="<?php echo html_escape($settings->paypal_email); ?>" class="form-control" >
                            </div>
                        </div>
                      </div>
                    </div>

                    <!-- tab 5 -->
                    <div class="tab-pane" id="content5" aria-hidden="false">
                      <div class="box-body">
                        <div class="form-group m-t-20">
                            <label class="col-sm-2 control-label" for="example-input-normal">Facebook</label>
                            <div class="col-sm-12">
                                <input type="text" name="facebook" value="<?php echo html_escape($settings->facebook); ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group m-t-20">
                            <label class="col-sm-2 control-label" for="example-input-normal">Twitter</label>
                            <div class="col-sm-12">
                                <input type="text" name="twitter" value="<?php echo html_escape($settings->twitter); ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group m-t-20">
                            <label class="col-sm-2 control-label" for="example-input-normal">Instagram</label>
                            <div class="col-sm-12">
                                <input type="text" name="instagram" value="<?php echo html_escape($settings->instagram); ?>" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group m-t-20">
                            <label class="col-sm-2 control-label" for="example-input-normal">Linkedin</label>
                            <div class="col-sm-12">
                                <input type="text" name="linkedin" value="<?php echo html_escape($settings->linkedin); ?>" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="example-input-normal">Google Analytics</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="google_analytics" rows="8"><?php echo base64_decode($settings->google_analytics) ?></textarea>
                            </div>
                        </div>
                      </div>
                    </div>
         

                </div>
              </div>

              <div class="col-md-4">

                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Preferences</h3>
                  </div>

                  <div class="box-body">
                    <div class="form-group row mb-10">
                      <label class="mt-5 col-md-5"><strong>Google reCaptcha</strong></label>
                      <div class="switch col-md-7">
                        <label>
                            <span class="switch_off">Disable</span>
                            <input type="checkbox" class="switch_setting" name="enable_captcha" value="1" <?php if($settings->enable_captcha == 1){echo "checked";} ?>>
                            <span class="lever"></span>
                            <span class="switch_on">Enable</span>
                        </label>
                      </div>
                    </div>

                    <div class="form-group row mb-10">
                      <label class="mt-5 col-md-5"><strong>Registration System</strong></label>
                      <div class="switch col-md-7">
                        <label>
                            <span class="switch_off">Disable</span>
                            <input type="checkbox" class="switch_setting" name="enable_registration" value="1" <?php if($settings->enable_registration == 1){echo "checked";} ?>>
                            <span class="lever"></span>
                            <span class="switch_on">Enable</span>
                        </label>
                      </div>
                    </div>

                    <div class="form-group row mb-10">
                      <label class="mt-5 col-md-5"><strong>Email Verification</strong></label>
                      <div class="switch col-md-7">
                        <label>
                            <span class="switch_off">Disable</span>
                            <input type="checkbox" class="switch_setting" name="enable_email_verify" value="1" <?php if($settings->enable_email_verify == 1){echo "checked";} ?>>
                            <span class="lever"></span>
                            <span class="switch_on">Enable</span>
                        </label>
                      </div>
                    </div>

                    <div class="form-group row mb-10">
                      <label class="mt-5 col-md-5"><strong>Paypal payment</strong></label>
                      <div class="switch col-md-7">
                        <label>
                            <span class="switch_off">Disable</span>
                            <input type="checkbox" class="switch_setting" name="enable_paypal" value="1" <?php if($settings->enable_paypal == 1){echo "checked";} ?>>
                            <span class="lever"></span>
                            <span class="switch_on">Enable</span>
                        </label>
                      </div>
                    </div>


                  </div>
                </div>

              </div>
            </div>

            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <div class="text-left">
                <div class="pull-left mb-20">
                    <button type="submit" class="btn btn-info waves-effect w-md waves-light m-b-5"><i class="fa fa-check"></i> Save Changes</button>
                </div>
            </div>

        </div>

      </form>

    </section>

</div>



