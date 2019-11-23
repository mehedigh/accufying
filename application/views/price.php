
<!-- start section -->
<section class="section">
    <div class="container">
        <div class="section-heading section-heading--center">
            <h3 class="__title">Small Business—friendly Pricing</h3>
            <p>We're offering a generous Free Plan and affordable premium pricing plans that grow with your business</p>
        </div>

        <div class="spacer py-2"></div>

        <div class="row">
            <div class="col-12">

                <div class="content-container">
                    <!-- start pricing table -->
                    <div class="pricing-table pricing-table--s4" data-aos="fade" data-aos-delay="150">
                        <div class="d-block">

                            <div class="pricing-switcher mb-5">
                                <p class="fieldset">
                                    <input type="radio" name="payment_type" value="monthly" class="switch_price" id="monthly-1">
                                    <label for="monthly-1">Monthly</label>
                                    <input type="radio" name="payment_type" value="yearly" class="switch_price" id="yearly-1" checked>
                                    <label for="yearly-1">Yearly</label>
                                    <span class="switch"></span>
                                </p>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive p-0">
                                <table class="text-center rounded shadow">
                                    <tbody>
                                        <thead class="thead mb-100">
                                            <tr>
                                                <td>
                                                    <h2>Pricing</h2>
                                                </td>
                                                <?php $a=1; foreach ($packages as $package): ?>
                                                <td class="<?php if($a==2){echo"active";} ?>">
                                                    <div class="theader">
                                                        <div class="__price mb-5">
                                                            <?php echo currency_to_symbol(settings()->currency); ?> 
                                                            <span class="price_year"><?php echo round($package->price); ?></span>
                                                            <span class="price_month" style="display: none;"><?php echo round($package->monthly_price); ?></span>
                                                        </div>
                                                        <p class="mt-0 bill_type">per year</p>
                                                    </div>
                                                </td>
                                                <?php $a++; endforeach; ?>
                                            </tr>
                                        </thead>

                                        <tr>
                                            <th>
                                                <div class="h4">Features</div>
                                            </th>
                                            <?php $i=1; foreach ($packages as $package): ?>
                                                <th class="<?php if($i==2){echo"active";} ?>">
                                                    <div class="__header">
                                                        <!-- <div class=""><sup>$</sup>0<sub>/mo</sub></div> -->
                                                        <div class="__title h4"><?php echo html_escape($package->name); ?> </div>
                                                    </div>

                                                </th>
                                            <?php $i++; endforeach; ?>
                                        </tr>

                                        <?php foreach ($features as $feature): ?>
                                            <tr class="monthly_row" style="display: none">
                                                <td><?php echo html_escape($feature->name); ?></td>
                                                <td class="text-center">
                                                <?php if ($feature->basic == 0): ?>
                                                  <p class="mb-0 feature-item"><i class="ico-unchecked fontello-minus"></i></p>
                                                <?php elseif($feature->basic == 1): ?>
                                                  <p class="mb-0 feature-item"><i class="ico-checked fontello-ok"></i></p>
                                                <?php elseif($feature->basic == 2): ?>
                                                  <p class="mb-0 feature-item">Unlimited</p>
                                                <?php else: ?>
                                                  <?php echo html_escape($feature->basic); ?>
                                                <?php endif ?>
                                              </td>
                                              <td class="text-center active">
                                                <?php if ($feature->standared == 0): ?>
                                                  <p class="mb-0 feature-item"><i class="ico-unchecked fontello-cancel"></i></p>
                                                <?php elseif($feature->standared == 1): ?>
                                                  <p class="mb-0 feature-item"><i class="ico-checked fontello-ok"></i></p>
                                                <?php elseif($feature->standared == 2): ?>
                                                  <p class="mb-0 feature-item">Unlimited</p>
                                                <?php else: ?>
                                                  <?php echo html_escape($feature->standared); ?>
                                                <?php endif ?>
                                              </td>
                                              <td class="text-center">
                                                <?php if ($feature->premium == 0): ?>
                                                  <p class="mb-0 feature-item"><i class="ico-unchecked fontello-minus"></i></p>
                                                <?php elseif($feature->premium == 1): ?>
                                                  <p class="mb-0 feature-item"><i class="ico-checked fontello-ok"></i></p>
                                                <?php elseif($feature->premium == 2): ?>
                                                  <p class="mb-0 feature-item">Unlimited</p>
                                                <?php else: ?>
                                                  <?php echo html_escape($feature->premium); ?>
                                                <?php endif ?>
                                              </td>
                                            </tr>
                                        <?php endforeach; ?>

                                        <?php foreach ($features as $feature): ?>
                                            <tr class="yearly_row">
                                                <td><?php echo html_escape($feature->name); ?></td>
                                                <td class="text-center">
                                                <?php if ($feature->year_basic == 0): ?>
                                                  <p class="mb-0 feature-item"><i class="ico-unchecked fontello-minus"></i></p>
                                                <?php elseif($feature->year_basic == 1): ?>
                                                  <p class="mb-0 feature-item"><i class="ico-checked fontello-ok"></i></p>
                                                <?php elseif($feature->year_basic == 2): ?>
                                                  <p class="mb-0 feature-item">Unlimited</p>
                                                <?php else: ?>
                                                  <?php echo html_escape($feature->year_basic); ?>
                                                <?php endif ?>
                                              </td>
                                              <td class="text-center active">
                                                <?php if ($feature->year_standared == 0): ?>
                                                  <p class="mb-0 feature-item"><i class="ico-unchecked fontello-cancel"></i></p>
                                                <?php elseif($feature->year_standared == 1): ?>
                                                  <p class="mb-0 feature-item"><i class="ico-checked fontello-ok"></i></p>
                                                <?php elseif($feature->year_standared == 2): ?>
                                                  <p class="mb-0 feature-item">Unlimited</p>
                                                <?php else: ?>
                                                  <?php echo html_escape($feature->year_standared); ?>
                                                <?php endif ?>
                                              </td>
                                              <td class="text-center">
                                                <?php if ($feature->year_premium == 0): ?>
                                                  <p class="mb-0 feature-item"><i class="ico-unchecked fontello-minus"></i></p>
                                                <?php elseif($feature->year_premium == 1): ?>
                                                  <p class="mb-0 feature-item"><i class="ico-checked fontello-ok"></i></p>
                                                <?php elseif($feature->year_premium == 2): ?>
                                                  <p class="mb-0 feature-item">Unlimited</p>
                                                <?php else: ?>
                                                  <?php echo html_escape($feature->year_premium); ?>
                                                <?php endif ?>
                                              </td>
                                            </tr>
                                        <?php endforeach; ?>

                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <?php $b=1; foreach ($packages as $package): ?>
                                                <td class="<?php if($b==2){echo"active";} ?>">
                                                    <a class="custom-btn custom-btn--medium custom-btn--style-3" href="<?php echo base_url('register') ?>">Get Started</a>
                                                </td>
                                                <?php $b++; endforeach; ?>
                                            </tr>
                                        </tfoot>

                                        
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- end pricing table -->
                </div>

            </div>
        </div>
        <div class="spacer py-4"></div>
    </div>
</section>
<!-- end section -->