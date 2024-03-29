<div class="content-wrapper">

  <section class="content"> 


    <div class="row mb-20">
     
      <div class="col-md-3">
        <div class="dash-info">
            <div class="row">
                <div class="col-sm-4">
                  <div class="ico-wrap bg-primary">
                    <i class="flaticon-accept"></i>
                  </div>
                </div>
                <div class="col-sm-8">
                  <div class="total-wrap">
                    <span><?php echo html_escape($invoices) ?></span><br>
                    <p>Invoices</p>
                  </div>
                </div>
            </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="dash-info">
            <div class="row">
                <div class="col-sm-4">
                  <div class="ico-wrap bg-orange">
                    <i class="flaticon-legal-paper"></i>
                  </div>
                </div>
                <div class="col-sm-8">
                  <div class="total-wrap">
                    <span><?php echo html_escape($estimates) ?></span><br>
                    <p>Estimates</p>
                  </div>
                </div>
            </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="dash-info">
            <div class="row">
                <div class="col-sm-4">
                  <div class="ico-wrap bg-green">
                    <i class="flaticon-group"></i>
                  </div>
                </div>
                <div class="col-sm-8">
                  <div class="total-wrap">
                    <span><?php echo html_escape($total_users) ?></span><br>
                    <p>Users</p>
                  </div>
                </div>
            </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="dash-info">
            <div class="row">
                <div class="col-sm-4">
                  <div class="ico-wrap bg-warning">
                    <i class="flaticon-suitcase"></i>
                  </div>
                </div>
                <div class="col-sm-8">
                  <div class="total-wrap">
                    <span><?php echo html_escape($business) ?></span><br>
                    <p>Business</p>
                  </div>
                </div>
            </div>
        </div>
      </div>

    </div>


   
    <div class="row mt-20">
      
      <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Packages by Users</h3>
            </div>
            <div class="box-body">
              <div class="row">
                  <div class="col-md-3">
                      <div class="row br1">
                      <?php foreach ($upackages as $package): ?>
                        <div class="dash-package">
                          <h5 class="mb-0"><?php echo html_escape($package->name) ?> Package</h5>
                          <p class="mt-0"><strong><?php echo html_escape($package->total) ?></strong> users</p>
                        </div>
                      <?php endforeach ?>
                    </div>
                  </div>

                  <div class="col-md-9">
                    <div class="row">
                      <div class="col-sm-12">
                        <div id="packagePie"></div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>

        <div class="box">
          <div class="box-header with-border">
              <h3 class="box-title">Recently joined Users</h3>
          </div>

          <div class="box-body p-0">
            <div class="media-list media-list-hover media-list-divided">
            
            <?php if (empty($users)): ?>
              <div class="text-center">
                <p class="p-20">No users found !</p>
              </div>
            <?php else: ?>
              
            
            <?php foreach ($users as $user): ?>
            
              <div class="media">
                <span class="avatar avatar-sm bg-default text-info"><i class="flaticon-user-1"></i></span>
                <div class="media-body">
                <p>
                  <a class="hover-primary" href="#"><strong><?php echo html_escape($user->name) ?></strong></a>
                  <time class="float-right" datetime="<?php echo my_date_show($user->created_at) ?>"><?php echo get_time_ago($user->created_at) ?></time>
                </p>
                <p><?php echo html_escape($user->email); ?></p>
                <span class="label label-default"><?php echo html_escape($user->package_name); ?></span>
                
                <?php $label = ''; ?>
                <?php if ($user->payment_status == 'expire'){
                    $label = 'danger';
                  }else if($user->payment_status == 'pending'){ 
                    $label = 'warning';
                  }else if($user->payment_status == 'verified'){ 
                    $label = 'primary';
                  }?>
                  <?php if (!empty($label)): ?>
                    <span class="label label-<?php echo html_escape($label) ?>"><?php echo html_escape($user->payment_status); ?></span>
                  <?php endif ?>
                </div>
              </div>

            <?php endforeach ?>
              <div class="text-center bt-1 border-light p-2">
                <a class="text-uppercase d-block font-size-12" href="<?php echo base_url('admin/users') ?>">See all Users <i class="fa fa-long-arrow-right"></i></a>
              </div>

            <?php endif ?>
            </div>

          </div>
        </div>
      </div>

      <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Last 12 months Income</h3>
                </div>
                <div class="box-body">
                    <div id="adminIncomeChart"></div>
                </div>
            </div>

            <div class="box mt-10">
                <div class="box-header with-border">
                    <h3 class="box-title">Net Income</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Fiscal year <i class="flaticon-information" data-toggle="tooltip" data-title="Fiscal year start is January 01"></i></th>
                            <?php foreach ($net_income as $netincome): ?>
                              <th><?php echo show_year($netincome->created_at) ?></th>
                            <?php endforeach ?>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Income</td>
                            <?php foreach ($net_income as $netincome): ?>
                              <td><?php echo currency_to_symbol(settings()->currency); ?><?php echo html_escape(round($netincome->total)) ?></td>
                            <?php endforeach ?>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
</div>