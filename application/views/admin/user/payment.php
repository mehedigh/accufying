<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <?php $settings = get_settings(); ?>
    <?php
        $paypal_url = ($settings->paypal_mode == 'sandbox')?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';
        $paypal_id= html_escape($settings->paypal_email);
    ?>
     
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                
                <div class="pay-box">

                    <h2 class="">Paypal Payment | Upgrade Plan</h2><br>
                    <?php if ($billing_type == 'monthly'): ?>
                        <?php $price = round($package->monthly_price); $frequency = 'per month';?>
                    <?php else: ?>
                        <?php $price = round($package->price); $frequency = 'per year';?>
                    <?php endif ?>

                    <!-- PRICE ITEM -->
                    <form action="<?php echo html_escape($paypal_url); ?>" method="post" name="frmPayPal1">
                        <div class="pipanel price panel-red">
                            <input type="hidden" name="business" value="<?php echo html_escape($paypal_id); ?>" readonly>
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="item_name" value="<?php echo html_escape($package->name);?>">
                            <input type="hidden" name="item_number" value="1">
                            <input type="hidden" name="amount" value="<?php echo html_escape($price) ?>" readonly>
                            <input type="hidden" name="no_shipping" value="1">
                            <input type="hidden" name="currency_code" value="<?php echo html_escape($settings->currency);?>">
                            <input type="hidden" name="cancel_return" value="<?php echo base_url('admin/subscription/payment_cancel/'.html_escape($package->id).'/'.html_escape($payment_id)) ?>">
                            <input type="hidden" name="return" value="<?php echo base_url('admin/subscription/payment_success/'.html_escape($package->id).'/'.html_escape($payment_id)) ?>">  
                                
                            <div class="panel-heading text-center">
                                <h3 class="mb-0">Package Plan: <?php echo html_escape($package->name);?></h3>
                            </div>
                            <div class="panel-body text-center p-0">
                                <p class="lead fs-30"><strong><?php echo currency_to_symbol(settings()->currency); ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong></p>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-lg btn-infocs p-0" href="#">PAY NOW <?php echo currency_to_symbol(settings()->currency); ?><?php echo html_escape($price) ?></button>
                            </div>
                        </div>
                    </form>
                    <!-- /PRICE ITEM -->

                </div>

            </div>
        </div>
    </div>

    
  </section>

</div>