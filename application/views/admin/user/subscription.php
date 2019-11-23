<div class="content-wrapper">
  <!-- Main content -->
  <section class="content"> 
    <div class="row">
        <div class="col-md-4">
              <div class="box add_area">
                <div class="box-header">
                  <h3 class="box-title">Subscription </h3>
                </div>

                <div class="box-body">
                  <p>Your subscription: <strong><?php echo html_escape($user->package_name) ?> Plan</strong></p>
                  <p>Price: <strong><?php echo html_escape($user->amount) ?> <?php echo html_escape($settings->currency) ?></strong></p>
                  <p>Billing Frequency : <strong><?php echo ucfirst(html_escape($user->billing_type)) ?></strong> </p>
                  <p>Last Billing : <strong><?php echo my_date_show($user->created_at) ?></strong> </p>
                  <p>Next Billing : <strong><?php echo my_date_show($user->expire_on); ?></strong> 
                   <strong class="text-danger">(<?php echo date_dif(date('Y-m-d'), $user->expire_on) ?> days left)</strong></strong></p>
                </div>
              </div>
        </div>

        <div class="col-md-8">
              <div class="box add_area">
                <div class="box-header">
                  <h3 class="box-title">Upgrade Plan </h3>
                </div>

                <div class="box-body">
                 
                  <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-20 p-0">
                    <div class="col-md-12 col-sm-12 col-xs-12 scroll">

                      <div class="pricing-switcher mb-5 text-center">
                          <p class="fieldset">
                              <input type="radio" name="billing_type" value="monthly" class="switch_price" id="monthly-1" <?php if($user->billing_type == 'monthly'){echo "checked";} ?>>
                              <label for="monthly-1">Monthly</label> &emsp;&emsp;
                              <input type="radio" name="billing_type" value="yearly" class="switch_price" id="yearly-1" <?php if($user->billing_type == 'yearly'){echo "checked";} ?>>
                              <label for="yearly-1">Yearly</label>
                              <span class="switch"></span>
                          </p>
                      </div>

                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td width="30%"><h2></h2></td>
                                    <?php $i=1; foreach ($packages as $package): ?>
                                      <td class="text-center">
                                        <h2 class="mt-10"><?php echo html_escape($package->name); ?></h2>
                                        <h4 class="mb-15">
                                        
                                        <span class="price_year" style="display: <?php if($user->billing_type == 'yearly'){echo "block";}else{echo "none";} ?>"><?php echo currency_to_symbol(settings()->currency); ?><?php echo round($package->price); ?> per year</span>
                                        <span class="price_month" style="display: <?php if($user->billing_type == 'monthly'){echo "block";}else{echo "none";} ?>"><?php echo currency_to_symbol(settings()->currency); ?><?php echo round($package->monthly_price); ?> per month</span>
                                        </h4>
                                      </td>
                                    <?php $i++; endforeach; ?>
                                </tr>
                                
                                <?php foreach ($features as $feature): ?>
                                  <tr class="monthly_row" style="display: none;">
                                      <td width="30%"><?php echo html_escape($feature->name); ?></td>
                                      <td class="text-center">
                                        <?php if ($feature->basic == 0): ?>
                                          <p class="mb-0 feature-item"><i class="fa fa-times text-danger"></i></p>
                                        <?php elseif($feature->basic == 1): ?>
                                          <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                        <?php elseif($feature->basic == 2): ?>
                                          <p class="mb-0 feature-item">Unlimited</p>
                                        <?php else: ?>
                                          <?php echo html_escape($feature->basic); ?>
                                        <?php endif ?>
                                      </td>
                                      <td class="text-center">
                                        <?php if ($feature->standared == 0): ?>
                                          <p class="mb-0 feature-item"><i class="fa fa-times text-danger"></i></p>
                                        <?php elseif($feature->standared == 1): ?>
                                          <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                        <?php elseif($feature->standared == 2): ?>
                                          <p class="mb-0 feature-item">Unlimited</p>
                                        <?php else: ?>
                                          <?php echo html_escape($feature->standared); ?>
                                        <?php endif ?>
                                      </td>
                                      <td class="text-center">
                                        <?php if ($feature->premium == 0): ?>
                                          <p class="mb-0 feature-item"><i class="fa fa-times text-danger"></i></p>
                                        <?php elseif($feature->premium == 1): ?>
                                          <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                        <?php elseif($feature->premium == 2): ?>
                                          <p class="mb-0 feature-item">Unlimited</p>
                                        <?php else: ?>
                                          <?php echo html_escape($feature->premium); ?>
                                        <?php endif ?>
                                      </td>
                                  </tr>

                                  <tr class="yearly_row">
                                      <td width="30%"><?php echo html_escape($feature->name); ?></td>
                                      <td class="text-center">
                                        <?php if ($feature->year_basic == 0): ?>
                                          <p class="mb-0 feature-item"><i class="fa fa-times text-danger"></i></p>
                                        <?php elseif($feature->year_basic == 1): ?>
                                          <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                        <?php elseif($feature->year_basic == 2): ?>
                                          <p class="mb-0 feature-item">Unlimited</p>
                                        <?php else: ?>
                                          <?php echo html_escape($feature->year_basic); ?>
                                        <?php endif ?>
                                      </td>
                                      <td class="text-center">
                                        <?php if ($feature->year_standared == 0): ?>
                                          <p class="mb-0 feature-item"><i class="fa fa-times text-danger"></i></p>
                                        <?php elseif($feature->year_standared == 1): ?>
                                          <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                        <?php elseif($feature->year_standared == 2): ?>
                                          <p class="mb-0 feature-item">Unlimited</p>
                                        <?php else: ?>
                                          <?php echo html_escape($feature->year_standared); ?>
                                        <?php endif ?>
                                      </td>
                                      <td class="text-center">
                                        <?php if ($feature->year_premium == 0): ?>
                                          <p class="mb-0 feature-item"><i class="fa fa-times text-danger"></i></p>
                                        <?php elseif($feature->year_premium == 1): ?>
                                          <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                        <?php elseif($feature->year_premium == 2): ?>
                                          <p class="mb-0 feature-item">Unlimited</p>
                                        <?php else: ?>
                                          <?php echo html_escape($feature->year_premium); ?>
                                        <?php endif ?>
                                      </td>
                                  </tr>
                                <?php endforeach ?>


                                <tr>
                                    <td></td>
                                    <?php $b=1; foreach ($packages as $package): ?>
                                        <td class="<?php if($b==2){echo"active";} ?> text-center">
                                            <a href="<?php echo base_url('admin/subscription/upgrade/'.$package->slug) ?>" class="btn btn-<?php if($b==2){echo"info";}else{echo "default";} ?> package_btn"><?php if($b==1){echo"Downgrade";}else{echo "Upgrade";} ?></a>
                                        </td>
                                    <?php $b++; endforeach; ?>
                                    <input type="hidden" name="billing_type" class="billing_type" value="<?php if($user->billing_type == 'monthly'){echo "monthly";}else{echo "yearly";} ?>">
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>

                </div>
              </div>
        </div>
    </div>
  </section>

</div>
