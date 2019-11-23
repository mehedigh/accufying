
<section class="section p-0 mt--50">
    <div class="container">
        <?php if ($settings->enable_registration == 0): ?>
            <div class="col-md-12 text-center">
                <h2 class="text-danger p-200">Registration system is disabled !</h2>
            </div>
        <?php else: ?>

            <div class="row">
                <div class="col-md-12 text-center">
                    <a class="site-logo" href="<?php echo base_url() ?>">
                        <img class="img-fluid" width="70%" src="<?php echo base_url($settings->logo) ?>" alt="demo" />
                    </a>
                    <h3 class="mb-0"><?php echo html_escape($settings->site_title) ?></h3>
                    <h4 class="mt-2"><?php echo html_escape($settings->site_name) ?><span> helps Entrepreneurs to manage their business & finances.</span></h4>
                </div>
            </div>
            
            <div class="spacer py-2"></div>
           
            <div class="row">
                <ul class="progressbar">
                    <li class="step_1 active">Sign Up</li>
                    <li class="step_2">Business</li>
                    <li class="step_3">Package</li>
                </ul>
            </div>

            <div class="account_area row justify-content-md-center mt-0">
                
                <div class="col-md-6 col-lg-6 col-sm-12 text-left d-none d-md-block">
                    <img src="<?php echo base_url() ?>assets/front/img/register.jpg">
                </div>

                <div class="col-md-6 col-lg-6 col-sm-12 text-left">
                    
                    <div class="spacer py-7"></div>

                    <form id="register_form" class="authorization__form authorization__form--shadow leave_con" method="post" action="<?php echo base_url('register_user'); ?>" >
                        <h4 class="__title">Sign Up</h4>
                        <div class="input-wrp">
                            <input class="textfield textfield--grey" type="text" name="name" placeholder="Full Name" required />
                        </div>

                        <div class="input-wrp">
                            <input class="textfield textfield--grey" type="email" name="email" placeholder="Email" inputmode="email" x-inputmode="email" required />
                        </div>

                        <div class="input-wrp">
                            <input class="textfield textfield--grey" type="password" name="password" placeholder="Password" required />
                        </div>

                        <p>
                            <label class="checkbox mt-0">
                                <input name="agree" class="agree_btn" type="checkbox" value="ok" required />
                                <i class="fontello-check"></i><span>I agree with Terms of Services</span>
                            </label>
                        </p>

                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                        <div class="col-md-12">
                            <?php if ($settings->enable_captcha == 1 && $settings->captcha_site_key != ''): ?>
                                <div class="g-recaptcha pull-left" data-sitekey="<?php echo html_escape($settings->captcha_site_key); ?>"></div>
                            <?php endif ?>
                        </div>

                        <button class="custom-btn custom-btn--medium custom-btn--style-2 wide submit_btn loader_btn" type="submit" disabled="disabled">Get Started </button>

                    </form>
                </div>
            </div>




            <div class="business_area justify-content-md-center mt-0" style="display: none;">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 text-left">
                        <img src="<?php echo base_url() ?>assets/front/img/business.jpg">
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12 text-left">
                        
                        <div class="spacer py-7"></div>

                        <form id="business_form" class="authorization__form authorization__form--shadow leave_con" method="post" action="<?php echo base_url('create-business'); ?>">
                            <h4 class="__title">Setup your first Business</h4>
                            <div class="input-wrp">
                                <input class="textfield textfield--grey" type="text" name="name" placeholder="Business Name" />
                            </div>

                            <div class="input-wrp">
                                <select class="selectfield textfield--grey single_select col-sm-12 single_select wd-100" id="country" name="country" style="width: 100%">
                                    <option value="">Select Country</option>
                                    <?php foreach ($countries as $country): ?>
                                        <option value="<?php echo html_escape($country->id); ?>" 
                                            >
                                            <?php echo html_escape($country->name); ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="input-wrp">
                                <select class="selectfield textfield--grey single_select col-sm-12 single_select wd-100" name="category" style="width: 100%">
                                    <option value="">Select Business Type</option>
                                    <?php foreach ($business as $busines): ?>
                                        <option value="<?php echo html_escape($busines->id); ?>" 
                                            >
                                            <?php echo html_escape($busines->name); ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                            <button class="custom-btn custom-btn--medium custom-btn--style-2 wide" type="submit" role="button">Create</button>
                        </form>
                    </div>
                </div>
            </div>



            <div class="loader"></div>

            <div class="pricing_area row justify-content-md-center mt-0 animate-ltr" style="display: none;">
               
               <div class="spacer py-4"></div>

                <h4 class="__title">You are almost done !</h4>
                <div class="col-md-12 col-lg-12 col-sm-12 text-left">
                    <div class="pricing-table pricing-table--s4" data-aos="fade" data-aos-delay="150">
                        <div class="d-none d-lg-block">
                            <div class="pricing-switcher mb-5">
                                <p class="fieldset">
                                    <input type="radio" name="billing_type" value="monthly" class="switch_price" id="monthly-1">
                                    <label for="monthly-1">Monthly</label>
                                    <input type="radio" name="billing_type" value="yearly" class="switch_price" id="yearly-1" checked>
                                    <label for="yearly-1">Yearly</label>
                                    <span class="switch"></span>
                                </p>
                            </div>

                            <table class="text-center rounded shadow">
                                <tbody>
                                    <thead class="thead" style="margin-bottom: 100px">
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
                                                    <a class="custom-btn custom-btn--medium custom-btn--style-3 package_btn" href="<?php echo base_url('package/'.$package->id) ?>">Choose Plan</a>
                                                    <input type="hidden" name="billing_type" class="billing_type" value="yearly">
                                                </td>
                                            <?php $b++; endforeach; ?>
                                        </tr>
                                    </tfoot>
                                    
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="spacer py-4"></div>
            </div>

        <?php endif ?>
    </div>
</section>

